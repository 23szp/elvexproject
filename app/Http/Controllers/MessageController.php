<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('throttle:20,1')->only(['sendToUser', 'sendFromProduct']);
    }


    public function index()
    {
        $userId = Auth::id();
        
   
        $productIds = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->select('product_id')
            ->distinct()
            ->pluck('product_id');
            
        $conversations = [];
        
  
        foreach ($productIds as $productId) {
            $product = Product::find($productId);
            
            if (!$product) continue;
            
       
            if ($product->user_id === $userId) {
             
                $chatPartners = Message::where('product_id', $productId)
                    ->where(function($query) use ($userId) {
                        $query->where('sender_id', $userId)
                              ->orWhere('receiver_id', $userId);
                    })
                    ->select(DB::raw('CASE 
                        WHEN sender_id = '.$userId.' THEN receiver_id 
                        ELSE sender_id 
                        END as partner_id'))
                    ->distinct()
                    ->pluck('partner_id');
                    
               
                foreach ($chatPartners as $partnerId) {
                    $partner = User::find($partnerId);
                    
                    if (!$partner) continue;
                    
                    $lastMessage = Message::where('product_id', $productId)
                        ->where(function($query) use ($userId, $partnerId) {
                            $query->where(function($q) use ($userId, $partnerId) {
                                $q->where('sender_id', $userId)
                                  ->where('receiver_id', $partnerId);
                            })->orWhere(function($q) use ($userId, $partnerId) {
                                $q->where('sender_id', $partnerId)
                                  ->where('receiver_id', $userId);
                            });
                        })
                        ->with(['sender', 'receiver', 'product'])
                        ->latest('created_at')
                        ->first();
                        
                    if ($lastMessage) {
                        if (!isset($conversations[$productId])) {
                            $conversations[$productId] = [];
                        }
                        
                    
                        $conversationKey = $productId . '_' . $partnerId;
                        $conversations[$productId][$conversationKey] = [
                            'message' => $lastMessage,
                            'partner' => $partner,
                            'unread_count' => Message::where('product_id', $productId)
                                ->where('sender_id', $partnerId)
                                ->where('receiver_id', $userId)
                                ->where('is_read', false)
                                ->count()
                        ];
                    }
                }
            } else {

                $lastMessage = Message::where('product_id', $productId)
                    ->where(function($query) use ($userId) {
                        $query->where('sender_id', $userId)
                              ->orWhere('receiver_id', $userId);
                    })
                    ->with(['sender', 'receiver', 'product'])
                    ->latest('created_at')
                    ->first();
                    
                if ($lastMessage) {
                    $partnerId = $lastMessage->sender_id === $userId ? $lastMessage->receiver_id : $lastMessage->sender_id;
                    $partner = User::find($partnerId);
                    
                    if (!$partner) continue;
                    
                    if (!isset($conversations[$productId])) {
                        $conversations[$productId] = [];
                    }
                    
           
                    $conversationKey = $productId . '_' . $partnerId;
                    $conversations[$productId][$conversationKey] = [
                        'message' => $lastMessage,
                        'partner' => $partner,
                        'unread_count' => Message::where('product_id', $productId)
                            ->where('sender_id', $partnerId)
                            ->where('receiver_id', $userId)
                            ->where('is_read', false)
                            ->count()
                    ];
                }
            }
        }
        
        return view('messages.index', compact('conversations'));
    }


    public function sendFromProduct(Request $request, Product $product)
    {
        $request->validate([
            'message' => 'required|string|max:256', 
        ]);

    
        $sanitizedMessage = htmlspecialchars($request->message, ENT_QUOTES, 'UTF-8');


        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $product->user_id,
            'product_id' => $product->id,
            'message' => $sanitizedMessage,
        ]);

    
        return redirect()->route('messages.show', ['user' => $product->user_id, 'productId' => $product->id])
            ->with('success', 'Üzenet sikeresen elküldve!');
    }

 
    public function show(User $user, $productId)
    {
 
        $product = Product::findOrFail($productId);
        $userId = Auth::id();
        
 
        $isProductOwner = $product->user_id === $userId;
        
        $hasConversation = Message::where('product_id', $productId)
            ->where(function($query) use ($user, $userId) {
                $query->where(function($q) use ($user, $userId) {
                    $q->where('sender_id', $userId)
                      ->where('receiver_id', $user->id);
                })->orWhere(function($q) use ($user, $userId) {
                    $q->where('sender_id', $user->id)
                      ->where('receiver_id', $userId);
                });
            })
            ->exists();
            
    
        $isParticipant = $isProductOwner || $hasConversation || 
                         ($userId !== $product->user_id && $user->id === $product->user_id);
        
        if (!$isParticipant) {
            abort(403, 'Nincs jogosultsága megtekinteni ezt a beszélgetést');
        }


        $messages = Message::where(function ($query) use ($user, $productId, $userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', $user->id)
                  ->where('product_id', $productId);
        })->orWhere(function ($query) use ($user, $productId, $userId) {
            $query->where('sender_id', $user->id)
                  ->where('receiver_id', $userId)
                  ->where('product_id', $productId);
        })
        ->with(['sender', 'receiver', 'product'])
        ->orderBy('created_at', 'asc')
        ->get();

 
        Message::where('receiver_id', $userId)
            ->where('sender_id', $user->id)
            ->where('product_id', $productId)
            ->where('is_read', false)
            ->update(['is_read' => true]);
            

        $chatPartners = [];
        if ($isProductOwner) {
            $chatPartners = Message::where('product_id', $productId)
                ->where(function($query) use ($userId) {
                    $query->where('sender_id', $userId)
                          ->orWhere('receiver_id', $userId);
                })
                ->select(DB::raw('CASE 
                    WHEN sender_id = '.$userId.' THEN receiver_id 
                    ELSE sender_id 
                    END as partner_id'))
                ->distinct()
                ->pluck('partner_id')
                ->map(function($partnerId) {
                    return User::find($partnerId);
                })
                ->filter()
                ->all();
        }

        return view('messages.show', compact('messages', 'user', 'product', 'chatPartners', 'isProductOwner'));
    }


    public function sendToUser(Request $request, User $user)
    {
        $request->validate([
            'message' => 'required|string|max:256',
            'product_id' => 'required|exists:products,id',
        ]);


        $product = Product::findOrFail($request->product_id);
        $userId = Auth::id();
        

        $isProductOwner = $product->user_id === $userId;
        $isMessageToOwner = $user->id === $product->user_id;
        

        $hasConversation = Message::where('product_id', $request->product_id)
            ->where(function($query) use ($user, $userId) {
                $query->where(function($q) use ($user, $userId) {
                    $q->where('sender_id', $userId)
                      ->where('receiver_id', $user->id);
                })->orWhere(function($q) use ($user, $userId) {
                    $q->where('sender_id', $user->id)
                      ->where('receiver_id', $userId);
                });
            })
            ->exists();
            
        if (!$isProductOwner && !$isMessageToOwner && !$hasConversation) {
            return response()->json([
                'success' => false,
                'message' => 'Nincs jogosultsága üzenetet küldeni erről a termékről'
            ], 403);
        }


        $sanitizedMessage = htmlspecialchars($request->message, ENT_QUOTES, 'UTF-8');


        $messageData = [
            'sender_id' => $userId,
            'receiver_id' => $user->id,
            'message' => $sanitizedMessage,
            'product_id' => $request->product_id,
        ];

        $message = Message::create($messageData);

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $message->id,
                'message' => $message->message,
                'created_at' => $message->created_at->diffForHumans(),
                'created_at_formatted' => $message->created_at->format('H:i'),
                'sender_id' => $message->sender_id,
                'product_id' => $message->product_id,
            ],
        ]);
    }
    public function fetchNewMessages(Request $request, $productId)
{
    $request->validate([
        'last_message_id' => 'required|integer',
    ]);

    $lastMessageId = $request->input('last_message_id');
    $timeout = 30; 
    $startTime = time();

    while (true) {
    
        $newMessages = Message::where('product_id', $productId)
            ->where('id', '>', $lastMessageId)
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();

        if ($newMessages->count() > 0) {
            return response()->json([
                'success' => true,
                'messages' => $newMessages,
            ]);
        }


        if (time() - $startTime > $timeout) {
            return response()->json([
                'success' => false,
                'messages' => [],
            ]);
        }

  
        usleep(500000);
    }
}
}
