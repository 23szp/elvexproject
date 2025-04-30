<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
<<<<<<< HEAD
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SavedProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MessageController; 
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home'); 

Route::get('/search', [HomeController::class, 'search'])->name('search'); 
Route::get('/aszf', function () {
    return view('pages.aszf');
})->name('aszf');

Route::get('/adatvedelmi-szabalyzat', function () {
    return view('pages.adatvedelmi');
})->name('adatvedelmi');

Route::get('/sugo', function () {
    return view('pages.sugo');
})->name('sugo');

Route::get('/rolunk', function () {
    return view('pages.rolunk');
})->name('rolunk');

Route::get('/kapcsolat', function () {
    return view('pages.kapcsolat');
})->name('kapcsolat');

Route::get('/hirdetes', function () {
    return view('pages.hirdetes');
})->name('hirdetes');
=======
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
>>>>>>> 4ecec8f1306eb8bbd1979d39463d687569b2f169

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

<<<<<<< HEAD
Route::get('/verify-email/{token}', [AuthController::class, 'verifyEmail'])->name('verify.email');
Route::get('/resend-verification', [AuthController::class, 'showResendForm'])->name('verification.form');
Route::post('/resend-verification', [AuthController::class, 'resendVerificationEmail'])->name('verification.resend');
Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
Route::get('/email/resend/{email}', [AuthController::class, 'resendVerificationEmailDirect'])->name('email.resend.direct');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('products', ProductController::class);
    Route::get('/categories/{parent}/children', [CategoryController::class, 'getChildren']);
    Route::delete('/products/{product}/images/{image}', [ProductController::class, 'deleteImage'])->name('products.deleteImage');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete-image', [ProfileController::class, 'deleteImage'])->name('profile.deleteImage');
    Route::put('/profile/update-image', [ProfileController::class, 'updateImage'])->name('profile.updateImage');
    Route::get('/profile/my-products', [ProfileController::class, 'myProducts'])->name('profile.my-products');

    Route::post('/products/{product}/mark-as-sold', [ProductController::class, 'markAsSold'])->name('products.mark-as-sold');

    Route::post('/products/{product}/save', [SavedProductController::class, 'save'])->name('products.save');
    Route::delete('/products/{product}/unsave', [SavedProductController::class, 'unsave'])->name('products.unsave');
    Route::get('/saved-products', [SavedProductController::class, 'index'])->name('saved-products.index');


Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
Route::post('/messages/send-from-product/{product}', [MessageController::class, 'sendFromProduct'])->name('messages.sendFromProduct');
Route::get('/messages/{user}/{productId}', [MessageController::class, 'show'])->name('messages.show');
Route::post('/messages/send-to-user/{user}', [MessageController::class, 'sendToUser'])->name('messages.sendToUser');
Route::post('/messages/fetch/{productId}', [MessageController::class, 'fetchNewMessages'])->name('messages.fetch');


});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users'); 
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/users/{user}/products', [AdminController::class, 'userProducts'])->name('admin.user-products');
    Route::get('/admin/users/{user}/logins', [AdminController::class, 'userLogins'])->name('admin.users.logins');

    Route::delete('/products/{product}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');

    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    Route::get('/categories/{parent}/children', [CategoryController::class, 'getChildren']);
=======
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('products', ProductController::class);
>>>>>>> 4ecec8f1306eb8bbd1979d39463d687569b2f169
});
