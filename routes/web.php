<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\WishlistComponent;
use App\Http\Livewire\user\UserDashboardComponent;
use App\Http\Livewire\admin\AdminDashboardComponent;
use App\Http\Livewire\admin\AdminCategoriesComponent;
use App\Http\Livewire\admin\AdminAddCategoryComponent;
use App\Http\Livewire\admin\AdminEditCategoryComponent;
use App\Http\Livewire\admin\AdminProductComponent;
use App\Http\Livewire\admin\AdminAddProductComponent;
use App\Http\Livewire\admin\AdminEditProductComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', HomeComponent::class)->name('home.index');
Route::get('/shop', ShopComponent::class)->name('shop');
Route::get('/product/{slug}', DetailsComponent::class)->name('product.details');
Route::get('/cart', CartComponent::class)->name('shop.cart');
Route::get('/product-category/{slug}',CategoryComponent::class)->name('product.category');
Route::get('/checkout', CheckoutComponent::class)->name('shop.checkout');
Route::get('/wishlist', WishlistComponent::class)->name('shop.wishlist');
Route::get('/search', SearchComponent::class)->name('product.search');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth','authadmin')->group(function () {
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/admin/categories', AdminCategoriesComponent::class)->name('admin.categories');
    Route::get('/admin/category/add', AdminAddCategoryComponent::class)->name('admin.category.add');
    Route::get('/admin/category/edit/{category_id}', AdminEditCategoryComponent::class)->name('admin.category.edit');
    Route::get('/admin/products}', AdminProductComponent::class)->name('admin.products');
    Route::get('/admin/products/add}', AdminAddProductComponent::class)->name('admin.products.add');
    Route::get('/admin/products/edit/{product_id}', AdminEditProductComponent::class)->name('admin.products.edit');
});

require __DIR__.'/auth.php';
