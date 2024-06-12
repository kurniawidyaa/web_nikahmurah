<?php

use App\DataTables\OrderDataTable;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriLayananController;
use App\Http\Controllers\KategoriPostController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('test', function () {
    return view('test');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {
    // Route::get('dashboard', [OrderController::class, 'dashboard'])->name('dashboard');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route dashboard menu
    Route::resource('konfigurasi/roles', RoleController::class);
    Route::resource('konfigurasi/permissions', PermissionController::class);
    Route::resource('store/kategori_layanans', KategoriLayananController::class);
    Route::resource('store/layanans', LayananController::class)->except('show');
    Route::resource('store/galeris', GaleriController::class);
    Route::resource('blog/kategori_posts', KategoriPostController::class);
    Route::resource('blog/posts', PostController::class);
    // Route::get('users', [UserController::class, 'index']);
    Route::resource('users/customers', UserController::class);
    Route::resource('users/admin', AdminController::class);
    Route::get('transaction/orders', [OrderController::class, 'dashboard'])->name('order.dashboard');
    Route::get('transaction/payment/{transaction_id}', [DashboardController::class, 'payment'])->name('dashboard.payment');

    // Route transaction
    Route::resource('cart_item', CartItemController::class);
    Route::get('cart/display/{transaction_id}', [CartController::class, 'display'])->name('cart.display');
    Route::resource('cart', CartController::class);

    Route::get('order/display', [OrderController::class, 'display'])->name('order.display');
    Route::resource('order', OrderController::class);
    Route::get('order/laporan', [OrderController::class, 'PdfOrder'])->name('order.pdf');

    Route::post('payment', [PaymentController::class, 'store'])->name('payment.store');
    Route::post('installment', [PaymentController::class, 'installment'])->name('payment.installment');
    Route::get('payment/display', [PaymentController::class, 'display'])->name('payment.display');
    Route::get('payment/{transaction_id}', [PaymentController::class, 'show'])->name('payment.show');
    Route::get('generate-pdf/{payment_id}', [OrderController::class, 'generate_pdf'])->name('pdf');

    // Route::get('blog/posts', [PostController::class, 'index']);
    // Route::get('blog/posts/{id}/edit', [PostController::class, 'edit']);
    // Route::get('blog/posts/{id}', [PostController::class, 'update']);
});

require __DIR__ . '/auth.php';

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/blog', [PostController::class, 'display'])->name('post.display');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('post.show');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/layanan', [LayananController::class, 'display'])->name('layanan.display');
Route::get('/layanan/{identifier}', [LayananController::class, 'show'])->name('layanan.detail');
Route::get('/galeri', [GaleriController::class, 'display'])->name('galeri.display');
