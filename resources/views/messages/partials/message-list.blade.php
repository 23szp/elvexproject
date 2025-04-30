<div id="messages" class="space-y-4 mb-6 overflow-y-auto h-96 p-4 border rounded-lg">
    @foreach ($messages as $message)
        <div class="flex items-start {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }} mb-4">
            @if ($message->sender_id !== auth()->id())
                <div class="flex-shrink-0 mr-3">
                    @php
                        // Ellenőrizzük, hogy a profile_image mező tartalmazza-e a "profile_images/" előtagot
                        $profileImagePath = Str::contains($message->sender->profile_image, 'profile_images/')
                            ? url('public/storage/' . $message->sender->profile_image)
                            : url('public/storage/profile_images/' . $message->sender->profile_image);
                    @endphp
                    <img class="h-10 w-10 rounded-full object-cover" 
                         src="{{ $message->sender->profile_image ? $profileImagePath : 'https://www.gravatar.com/avatar/' . md5($message->sender->email) . '?d=mp' }}" 
                         alt="{{ $message->sender->name }}">
                </div>
                <div class="bg-gray-100 rounded-lg p-3 max-w-md">
                    <p class="font-semibold text-sm text-gray-800">{{ $message->sender->name }}</p>
                    <p class="text-sm text-gray-800">{{ $message->message }}</p>
                    <span class="text-xs text-gray-400">{{ $message->created_at->diffForHumans() }}</span>
                </div>
            @else
                <div class="bg-purple-100 rounded-lg p-3 max-w-md">
                    <p class="text-sm text-purple-800">{{ $message->message }}</p>
                    <span class="text-xs text-purple-400">{{ $message->created_at->diffForHumans() }}</span>
                </div>
                <div class="flex-shrink-0 ml-3">
                    @php
                        // Ellenőrizzük, hogy a profile_image mező tartalmazza-e a "profile_images/" előtagot
                        $profileImagePath = Str::contains(auth()->user()->profile_image, 'profile_images/')
                            ? url('public/storage/' . auth()->user()->profile_image)
                            : url('public/storage/profile_images/' . auth()->user()->profile_image);
                    @endphp
                    <img class="h-10 w-10 rounded-full object-cover" 
                         src="{{ auth()->user()->profile_image ? $profileImagePath : 'https://www.gravatar.com/avatar/' . md5(auth()->user()->email) . '?d=mp' }}" 
                         alt="{{ auth()->user()->name }}">
                </div>
            @endif
        </div>
    @endforeach
</div>
