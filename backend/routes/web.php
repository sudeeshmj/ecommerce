<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\Books\CategoryController;
use App\Http\Controllers\Books\SubCategoryController;
use App\Http\Controllers\Books\AuthorController;
use App\Http\Controllers\Books\LanguageController;
use App\Http\Controllers\Books\BookController;
use App\Http\Controllers\Books\SettingsController;
use App\Http\Controllers\Customers\CustomerController;
use App\Events\OutOfStockEvent;
use App\Http\Controllers\Orders\OrderController;

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

Route::middleware('auth.redirect')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/do-login', [AuthController::class, 'doLogin'])->name('do.login');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('books')->middleware(['auth', 'prevent.back.history'])->group(function () {

    Route::get('/index', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('sub-categories', SubCategoryController::class);
    Route::resource('authors', AuthorController::class);
    Route::resource('languages', LanguageController::class);
    Route::resource('books', BookController::class);
    Route::resource('settings', SettingsController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('orders', OrderController::class);
    Route::post('settings-store', [SettingsController::class, 'storeStoreSettings'])->name('settings.store.store');
    Route::post('settings-notification', [SettingsController::class, 'storeNotificationSettings'])->name('settings.notification.store');

    Route::post('api/fetch-subcategories', [BookController::class, 'fetchSubCategories'])->name('fetch.subcategories');
    Route::get('api/fetch-categories', [CategoryController::class, 'fetchCategories'])->name('fetch.categories');
    Route::post('api/change-orderstatus', [OrderController::class, 'changeOrderStatus'])->name('change.orderstatus');

    Route::get('locale/{lang}', [SystemController::class, 'setLang'])->name('language.change');
});


// Route::get('mailable',function(){
//     $book = App\Models\Book::find(1);
 
//     OutOfStockEvent::dispatch($book);
//    // return new App\Mail\OutOfStockMail($book);
// });