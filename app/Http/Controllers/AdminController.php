<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
 
    public function users()
    {
        
        $users = User::with(['loginLogs' => function ($query) {
            $query->latest()->first(); 
        }])->get();


        $users = $users->map(function ($user) {
            $user->last_login = $user->loginLogs->first();
            return $user;
        });

        return view('admin.users', compact('users')); 
    }

    
    public function editUser(User $user)
    {
        return view('admin.edit-user', compact('user'));
    }

    
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'is_admin' => 'boolean',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->is_admin = $request->has('is_admin');
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Felhasználó sikeresen frissítve!');
    }

    
    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Felhasználó sikeresen törölve!');
    }

   
    public function userProducts(User $user)
    {
        $products = $user->products;
        return view('admin.user-products', compact('user', 'products'));
    }

  
    public function deleteProduct(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Termék sikeresen törölve!');
    }


    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }


    public function createCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories',
        ]);

        Category::create($request->only('name', 'slug'));

        return redirect()->route('admin.categories')->with('success', 'Kategória sikeresen létrehozva!');
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'Kategória sikeresen törölve!');
    }


    public function userLogins(User $user)
    {
        $logins = $user->loginLogs()->latest()->paginate(10); 
        return view('admin.user-logins', compact('user', 'logins'));
    }


    public function index()
    {
        $users = User::select(['id', 'name', 'email'])->get();
        return view('admin.users.index', compact('users'));
    }
}
