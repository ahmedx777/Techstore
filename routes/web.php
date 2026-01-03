<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use App\Models\Category;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Produits (admin)
    Route::get('/products', [ProductController::class, 'adminIndex'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.delete');

    // Catégories (admin)
    Route::get('/categories', [CategoryController::class, 'adminIndex'])->name('admin.categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');   // ✅ ajouté
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');   // ✅ ajouté
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');
     // ✅ Commandes (admin)
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
});




/*
|--------------------------------------------------------------------------
| Page d'accueil
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $categories = Category::all();
    return view('home', compact('categories'));
})->name('home');

/*
|--------------------------------------------------------------------------
| Authentification
|--------------------------------------------------------------------------
*/
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Produits (public)
|--------------------------------------------------------------------------
*/
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

/*
|--------------------------------------------------------------------------
| Catégories (public)
|--------------------------------------------------------------------------
*/
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

/*
|--------------------------------------------------------------------------
| Panier
|--------------------------------------------------------------------------
*/
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

/*
|--------------------------------------------------------------------------
| Commandes
|--------------------------------------------------------------------------
*/
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

/*
|--------------------------------------------------------------------------
| Favoris
|--------------------------------------------------------------------------
*/
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
Route::get('/favorites/add/{product_id}', [FavoriteController::class, 'add'])->name('favorites.add');
Route::get('/favorites/remove/{product_id}', [FavoriteController::class, 'remove'])->name('favorites.remove');

/*
|--------------------------------------------------------------------------
| Avis / Reviews
|--------------------------------------------------------------------------
*/
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');
/*
|--------------------------------------------------------------------------
| Avis / Checkout
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});