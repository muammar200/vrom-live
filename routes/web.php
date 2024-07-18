<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesController;
use Monolog\Handler\RotatingFileHandler;
use App\Http\Controllers\Front\DetailController;
use App\Http\Controllers\Front\CatalogController;
use App\Http\Controllers\Front\LandingController;
use App\Http\Controllers\Front\PaymentController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Auth\CustomRegisterController;
use App\Http\Controllers\Front\CheckoutStoreController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Http\Controllers\Admin\TypeController as AdminTypeController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

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

Route::name('front.')->group(function (){
    Route::get('/', [LandingController::class, 'index'])->name('index');
    Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
    Route::get('/detail/{slug}', [DetailController::class, 'index'])->name('detail');
    
    Route::middleware(['auth'])->group(function () { 
        Route::get('/checkout/{slug}', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout/{slug}', [CheckoutController::class, 'store'])->name('checkout.store');
        
        Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
        Route::get('/payment/{bookingId}', [PaymentController::class, 'index'])->name('payment');
        Route::post('/payment/{bookingId}', [PaymentController::class, 'update'])->name('payment.update');
    });
});

Route::prefix('admin')->name('admin.')->middleware([
'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin'
])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        Route::resource('brands', AdminBrandController::class);
        Route::resource('types', AdminTypeController::class);    
        Route::resource('items', AdminItemController::class);    
        Route::resource('bookings', AdminBookingController::class);    
});

Route::prefix('auth-custom')->name('auth-custom.')->group( function(){
    Route::post('/register', [CustomRegisterController::class, 'create'])->name('register');
});

