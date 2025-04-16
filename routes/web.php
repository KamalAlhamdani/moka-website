<?php

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

/* Route::get('/', function () {
    return view('welcome');
}); */

/* BySwadi */

use App\Http\Controllers\Utilities\LocalizationController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\RedirectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;



// Auth::routes();
if (config('app.activate_auth')) {

    Auth::routes(
        [
            'register' => false, // Registration Routes...
            'verify' => false, // Email Verification Routes...
            'reset' => false, // Password Reset Routes...
        ]
    );
    // Route::get('login', [LoginController::class, 'login'])->name('login');
}

// Localization Route
Route::get('lang/{locale}', [LocalizationController::class, 'index'])->name('lang');



Route::post('verify', [HomeController::class, 'verify']);
Route::get('get-order-for-inner-system', [HomeController::class, 'getOrdersForInnerSystem']);
Route::get('get-order-for-inner-system-object', [HomeController::class, 'getOrdersForInnerSystemObject']);
Route::get('get-past-orders', [HomeController::class, 'getAllOrdersForInnerSystemObject']);
//Route::get('verify', [HomeController::class, 'verify']);

/*Route::get('auth-user', function (){
    return 'auth user is here';
})->middleware('auth:api');*/

Route::prefix('/')->group(
    function () {
        // login "named routes are used"
        /*Route::middleware('auth')->get('/user', function (Request $request) {
        return auth()->user()->name;
        });*/

        // Route::post('login', [AuthController::class, 'login'])->name('web.login');

        // Route::post('register', [AuthController::class, 'register']);

        Route::group(
            ['middleware' => 'auth:api'], function () {
                Route::post('user-details', [AuthController::class, 'details']);
            }
        );
        // ./login

        Route::resource('/', HomeController::class);

        Route::get('/branches', [RedirectController::class, 'branches'])
        ->name('branches');

        Route::get('/about', [RedirectController::class, 'about'])
        ->name('about');

        Route::get('/contact-us', [RedirectController::class, 'contactUs'])
        ->name('contactUs');

        Route::get('/categories', [RedirectController::class, 'categories'])
        ->name('categories');

        Route::match(['get', 'post'], '/products', [RedirectController::class, 'products'])
        ->name('products');

        Route::get('/products/{id}', [RedirectController::class, 'product'])
        ->name('products.details');

        Route::get('/offers', [RedirectController::class, 'offers'])
        ->name('offers');

        Route::get('/offers/{id}', [RedirectController::class, 'offer'])
        ->name('offers.details');

        Route::get('/offers/type/{type}', [RedirectController::class, 'offerType'])
        ->name('offers.type');

        // Route::get('/products?most_sell=1', [RedirectController::class, 'mostSell']);
        Route::get('/products?most_sell', [RedirectController::class, 'mostSell'])
        ->name('mostSell.products');

        //For instance search
        Route::get('/product-query', [HomeController::class, 'search'])
        ->name('search.products');
    }
);

/* ./BySwadi */

// Auth::routes();

Route::get('/home', [HomeController::class , 'index'])->name('home');
// Route::get('/', 'HomeController@index')->name('main');

/*
 * Use these routes for auth:web middleware
 */
Route::group(
    ['middleware' => 'auth:web', 'middleware' => 'web'], function () {

        // Route::get('/web-auth', function (){return auth()->user();})
        // ->name('test.web.auth');

        Route::post('/favorite/add', [HomeController::class, 'favoritePost'])
        ->name('web.favorite.post');

        Route::post('/favorite/del/{product_id}', [HomeController::class, 'favoriteDel'])
        ->name('web.favorite.del');

        // Checkout
        Route::get('/checkout', [CartController::class, 'checkoutGet'])
        ->name('web.cart.get');

        Route::post('/checkout', [CartController::class, 'checkoutPost'])
        ->name('web.cart.post');

        Route::post('/checkout/{id}', [CartController::class, 'checkoutDelete'])
        ->name('web.cart.delete');

        Route::get('/checkout/items', [CartController::class, 'checkoutItems'])
            ->name('web.checkout.items')->middleware('checkout');

        Route::get('/checkout/delivery', [CartController::class, 'checkoutDelivery'])
            ->name('web.checkout.delivery')->middleware('checkout');

        Route::get('/checkout/payment', [CartController::class, 'checkoutPayment'])
            ->name('web.checkout.payment')->middleware('checkout');

        Route::get('/checkout/receipt', [CartController::class, 'checkoutReceipt'])
            ->name('web.checkout.receipt')->middleware('checkout');
        // ./Checkout

        // Session settings

        Route::post('/coupon/check', [CheckoutController::class, 'couponValidity'])
        ->name('web.coupon.check');

        Route::post('/coupon/remove', [CheckoutController::class, 'couponRemove'])
        ->name('web.coupon.remove');

        Route::post('/note/add', [CheckoutController::class, 'noteAdd'])
        ->name('web.note.add');

        Route::post('/note/remove', [CheckoutController::class, 'noteRemove'])
        ->name('web.note.remove');

        Route::post('/deliver/address', [CheckoutController::class, 'deliverAddress'])
        ->name('web.deliver.address.post');

        Route::post('/request/order', [CheckoutController::class, 'requestOrder'])
        ->name('web.request.order');

        // ./Session settings


    }
);

/**
 * By Alsaloul
 * a page show the policy and privacy
 */
Route::get(
    '/policy', [RedirectController::class, 'policy']
);

Route::get(
    '/terms', [RedirectController::class, 'terms']
);

Route::get(
    '/sitemap', [RedirectController::class, 'sitemap']
);

// Return special_classes (showcase categories)
Route::get(
    '/samples', [RedirectController::class, 'showcaseCategories']
)->name('samples-categories');

// Return special_classes (selected showcase categories)
Route::get(
    '/samples/{showcase}', [RedirectController::class, 'showcase']
)->name('samples');

/**
 * Test Routes: used in development environment
 * //TODO: remove these routes in production
 */
// Route::get('/coupon/{coupon}', 'Web\CheckoutController@couponValidity');
// Route::get(
//     '/domain_asset',
//     function () {
//         return domainAsset('image.jpg');
//     }
// );
