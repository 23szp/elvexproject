<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
    
        $products = $user->products()->latest()->paginate(12);

        return view('user.show', compact('user', 'products'));
    }
}