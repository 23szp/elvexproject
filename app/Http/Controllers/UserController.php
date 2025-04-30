<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
<<<<<<< HEAD

=======
    
>>>>>>> 4ecec8f1306eb8bbd1979d39463d687569b2f169
        $products = $user->products()->latest()->paginate(12);

        return view('user.show', compact('user', 'products'));
    }
<<<<<<< HEAD
    public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed',
        'is_admin' => 'sometimes'
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->is_admin = $request->has('is_admin') ? 1 : 0;
    

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('admin.users.index')
        ->with('success', 'Felhasználó sikeresen frissítve!');
}
=======
>>>>>>> 4ecec8f1306eb8bbd1979d39463d687569b2f169
}