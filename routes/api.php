<?php
/**
 * User API Controller
 * Cart
 * Category
 * Coupon
 * Favorite
 * Offer
 * Product
 */
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\OfferController;
use App\Http\Controllers\API\PasswordResetController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\WEB\CartController;
use App\Http\Controllers\WEB\HomeController;
use App\Http\Controllers\API\BranchController;
use App\Http\Controllers\API\ClaimController;
use App\Http\Controllers\API\AdvertisementController;
use App\Http\Controllers\API\ShowCaseController;
use App\Http\Controllers\API\DeliveryPricingController;
use App\Http\Controllers\API\TasteController;
use App\Http\Controllers\API\HospitalityController;
use App\Http\Controllers\API\SuggestionController;
use App\Http\Controllers\API\ChatController;
use App\Http\Controllers\API\EventTypeController;
use App\Http\Controllers\API\UserEventController;
use App\Http\Controllers\API\RateTypeController;
use App\Http\Controllers\API\RateController;
use App\Http\Controllers\API\FavoriteController;
use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\CeilingController;
use App\Http\Controllers\API\BoxingTypeController;
use App\Http\Controllers\API\VideoController;
use App\Http\Controllers\API\SpecialProductController;
use App\Http\Controllers\API\RequestController;
use App\Http\Controllers\API\CouponController;
use App\Http\Controllers\API\PointHistoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('SendPayment', [HomeController::class, 'SendPayment']);
Route::post('ReversePayment', [HomeController::class, 'ReversePayment']);
Route::post('verify', [HomeController::class, 'verify']);

Route::post('TadamonSendPayment', [HomeController::class, 'TadamonSendPayment']);
Route::post('TadamonConfirmPayment', [HomeController::class, 'TadamonConfirmPayment']);
Route::post('TadamonStatus', [HomeController::class, 'TadamonStatus']);

Route::middleware('auth:api')->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);

// Route::group(
//     ['middleware' => 'auth:api'], function () {
//         Route::apiResource(
//             'cart',
//             'API\CartController'
//         )->only(
//             [
//                 'index', 'show', 'store', 'destroy'
//             ]
//         );
//     }
// );
Route::group(
    [
        'middleware' => 'auth:api'
    ],
    function () {

        Route::post('password/change', [PasswordResetController::class, 'change']);
        // Route::post('password/change', [UserController::class, 'change']);

        Route::get('user', [UserController::class, 'details']);
        Route::Post('user/avatar', [UserController::class, 'change_image']);
        Route::delete('user/avatar', [UserController::class, 'delete_image']);



        Route::put('user', [UserController::class, 'update']);

        Route::apiResource('category', CategoryController::class)->only([
            'index', 'show'
        ]);

        Route::get('product/most_sell',  [ProductController::class, 'most_sell']);

        // Route::get('product/new',  [ProductController::class, 'new']); //BySwadi: commented and added name route
        Route::get('product/new',  [ProductController::class, 'new'])->name('products.new');
        Route::get('product/{id}/related',  [ProductController::class, 'related']);

        Route::apiResource('product', ProductController::class)->only([
            'index', 'show'
        ])->name('product', "show");

        Route::apiResource('cart', CartController::class)->only([
            'index', 'show', 'store', 'destroy'
        ]);

        Route::get('offer/{id}/related',  [OfferController::class, 'related']);
        Route::apiResource('offer', OfferController::class)->only([
            'index', 'show'
        ]);

        Route::apiResource('branch', BranchController::class)->only([
            'index', 'show'
        ]);

        Route::apiResource('claim', ClaimController::class)->only([
            'index', 'store'
        ]);
        Route::apiResource('advertisement', AdvertisementController::class)->only([
            'index',
        ]);
        Route::apiResource('showCase', ShowCaseController::class)->only([
            'index',
        ]);

        Route::apiResource('deliveryPricing', DeliveryPricingController::class)->only([
            'index','show'
        ]);



        Route::apiResource('taste', TasteController::class)->only([
            'index', 'show'
        ]);
        Route::apiResource('hospitality', HospitalityController::class)->only([
            'index', 'store'
        ]);


        Route::apiResource('suggestion', SuggestionController::class)->only([
            'index', 'store'
        ]);
        Route::apiResource('chat', ChatController::class)->only([
            'index', 'store'
        ]);

        Route::apiResource('event_type', EventTypeController::class)->only([
            'index', 'show', 'store'
        ]);


        Route::apiResource('user_event', UserEventController::class)->only([
            'index', 'destroy', 'store', 'update'
        ]);

        Route::apiResource('rate_type', RateTypeController::class)->only([
            'index', 'show', 'store'
        ]);

        Route::apiResource('rate', RateController::class)->only([
            'index', 'show', 'store'
        ]);

        Route::apiResource('favorite', FavoriteController::class)->only([
            'index', 'destroy', 'store'
        ]);

        Route::apiResource('address', AddressController::class)->only([
            'index', 'destroy', 'store', 'update'
        ]);

        Route::apiResource('ceiling', CeilingController::class)->only([
            'index', 'update'
        ]);
        Route::apiResource('boxingType', BoxingTypeController::class)->only([
            'index'
        ]);

        Route::apiResource('video', VideoController::class)->only([
            'index'
        ]);


        Route::apiResource('special_product', SpecialProductController::class)->only([
            'index', 'store', 'destroy', 'update'
        ]);

        Route::delete('request/{id}/cancel',  [RequestController::class, 'cancel']);

        Route::apiResource('request', RequestController::class)->only([
            'index', 'store', 'destroy', 'update', 'show'
        ]);
        Route::GET('coupon/checkCoupon/{coupon}',  [CouponController::class, 'checkCoupon']);
        Route::apiResource('coupon', CouponController::class)->only([
            'index', 'store', 'destroy', 'update', 'show'
        ]);



        Route::GET('point_history/sum',  [PointHistoryController::class, 'sum']);
        Route::POST('point_history/convert', [PointHistoryController::class, 'convert']);
        Route::GET('point_history/convert', [PointHistoryController::class, 'convertList']);
        Route::GET('point_history/monthly', [PointHistoryController::class, 'monthly_point_add']);
        Route::apiResource('point_history', PointHistoryController::class)->only([
            'index', 'store', 'destroy', 'update', 'show'
        ]);
    }
);

/* BySwadi */
Route::name('website.')->prefix('website')->group(
    function () {
        /* index: to Show the categories items
        * show: to show the products of selected category
        */
        Route::apiResource('category', CategoryController::class)
            ->only(['index', 'show']);

        Route::get('product/most_sell', [ProductController::class, 'most_sell']);

        Route::get('product/new', [ProductController::class, 'new']);

        Route::get('product/{id}/related', [ProductController::class, 'related']);

        Route::apiResource('product', ProductController::class)
            ->only(['index', 'show'])->name('product', "show");

        Route::get('offer/{id}/related', [OfferController::class, 'related']);

        Route::apiResource('offer', OfferController::class)
            ->only(['index', 'show']);

        Route::apiResource('branch', BranchController::class)
            ->only(['index', 'show']);

        Route::apiResource('suggestion', SuggestionController::class)
            ->only(['index', 'store']);

        Route::apiResource('video', VideoController::class)
            ->only(['index']);
    }
);
/* ./BySwadi */
