<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\LoginLog;

class ProfileController extends Controller
{
   
    public function show()
    {
   
        $loginLogs = LoginLog::where('user_id', Auth::id())
            ->latest()
            ->take(10) 
            ->get();

        return view('profile.show', compact('loginLogs'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
    
       
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'required|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
    
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'A jelenlegi jelszó nem megfelelő.']);
        }
    
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
    
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }
    
        $user->save();
    
        return redirect()->route('profile.show')->with('success', 'Profil sikeresen frissítve!');
    }

    public function deleteImage(Request $request)
    {
        $user = Auth::user();

        if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
            Storage::disk('public')->delete($user->profile_image);
        }

        $user->profile_image = null;
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profilkép sikeresen törölve!');
    }

    public function myProducts()
    {
        $products = Auth::user()->products()->latest()->paginate(12);
        return view('profile.my-products', compact('products'));
    }

    public function updateImage(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'profile_image' => 'required|image|max:2048',
        ]);

        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }

        $path = $request->file('profile_image')->store('profile_images', 'public');
        $user->profile_image = $path;
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profilkép sikeresen frissítve!');
    }

    public function logLoginEvent(Request $request)
    {
        LoginLog::create([
            'user_id' => Auth::id(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
        ]);
    }
}
