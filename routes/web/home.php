<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     if (Gate::allows('edit-user')){
//         return view('welcome');
//     }
//         return 'no';
// });









Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/', [HomeController::class , 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/product-detail/{id}', [HomeController::class , 'productDetail'])->name('product-detail');
Route::post('/add-cart/{id}', [HomeController::class , 'addToCart'])->name('add-cart');
//Route::get('/all-products',[HomeController::class,'allProduct'])->name('all-products');
Route::get('/show-carts',[HomeController::class,'showCarts'])->name('show-carts');
Route::delete('/delete-carts/{id}',[HomeController::class,'deleteCarts'])->name('delete-carts');
Route::get('/cash-order',[HomeController::class,'cashOrder'])->name('cash-order');
Route::get('/stripe/{totalPrice}',[HomeController::class,'stripe'])->name('stripe');
Route::post('stripe/{totalPrice}', [HomeController::class,'stripePost'])->name('stripe.post');

require __DIR__.'/../auth.php';
