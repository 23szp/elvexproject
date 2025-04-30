@extends('layouts.app')

@section('title', 'Admin - Felhasználók')

@section('content')
<div class="container mx-auto px-4" x-data="{ 
    users: {{ Illuminate\Support\Js::from($users->map(function($user) {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'last_login_html' => $user->lastLogin() 
                ? '<span class=\"text-sm text-gray-600\">' . $user->lastLogin()->created_at->format('Y-m-d H:i:s') . '<br>IP: ' . $user->lastLogin()->ip_address . '</span>'
                : '<span class=\"text-sm text-gray-600\">Nincs belépési adat</span>',
            'logins_url' => route('admin.users.logins', $user),
            'edit_url' => route('admin.users.edit', $user),
            'delete_url' => route('admin.users.delete', $user)
        ];
    })) }},
    search: '',
    get filteredUsers() {
        return this.users.filter(user => {
            const searchLower = this.search.toLowerCase();
            return user.name.toLowerCase().includes(searchLower) ||
                   user.email.toLowerCase().includes(searchLower);
        });
    }
}">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Felhasználók</h1>
        <div class="w-full md:w-72">
            <input
                type="text"
                x-model="search"
                placeholder="Keresés név vagy email alapján..."
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500"
            >
        </div>
    </div>

    <div class="hidden md:block bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Név</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Utolsó belépés</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Hirdetések</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Műveletek</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="user in filteredUsers" :key="user.id">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4" x-text="user.name"></td>
                        <td class="px-6 py-4" x-text="user.email"></td>
                        <td class="px-6 py-4" x-html="user.last_login_html"></td>
                        
                        <td class="px-6 py-4">
                            <a :href="`/admin/users/${user.id}/products`" class="text-purple-600 hover:text-purple-500">
                                Hirdetések megtekintése
                            </a>
                        </td>
                        
                        <td class="px-6 py-4 flex space-x-2">
                            <a :href="user.logins_url" class="text-green-600 hover:text-green-500">
                                Belépési naplók
                            </a>

                            <a :href="user.edit_url" class="text-blue-600 hover:text-blue-500">
                                Szerkesztés
                            </a>

                            <form :action="user.delete_url" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-500">
                                    Törlés
                                </button>
                            </form>
                        </td>
                    </tr>
                </template>
                
                <tr x-show="filteredUsers.length === 0" class="text-center">
                    <td colspan="5" class="px-6 py-4 text-gray-500">
                        Nincs találat a keresési feltételeknek megfelelően.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="md:hidden space-y-4">
        <template x-for="user in filteredUsers" :key="user.id">
            <div class="bg-white rounded-lg shadow-md p-4">
                <div class="mb-2">
                    <span class="font-semibold">Név:</span>
                    <span x-text="user.name"></span>
                </div>
                <div class="mb-2">
                    <span class="font-semibold">Email:</span>
                    <span x-text="user.email"></span>
                </div>
                <div class="mb-2">
                    <span class="font-semibold">Utolsó belépés:</span>
                    <span x-html="user.last_login_html"></span>
                </div>
                <div class="mb-3">
                    <a :href="`/admin/users/${user.id}/products`" class="text-purple-600 hover:text-purple-500 block py-1">
                        Hirdetések megtekintése
                    </a>
                </div>
                <div class="flex flex-wrap gap-3 border-t pt-3">
                    <a :href="user.logins_url" class="text-green-600 hover:text-green-500">
                        Belépési naplók
                    </a>
                    <a :href="user.edit_url" class="text-blue-600 hover:text-blue-500">
                        Szerkesztés
                    </a>
                    <form :action="user.delete_url" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-500">
                            Törlés
                        </button>
                    </form>
                </div>
            </div>
        </template>
        
        <div x-show="filteredUsers.length === 0" class="bg-white rounded-lg shadow-md p-4 text-center text-gray-500">
            Nincs találat a keresési feltételeknek megfelelően.
        </div>
    </div>
</div>
@endsection
