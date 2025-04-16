<?php
/**
 * Http web routes
 * php version 7.3.1
 *
 * @category Web
 * @package  Moka_APIs
 * @author   BySwadi <muath.ye@gmail.com>
 * @license  IC https://www.infinitecloud.co
 * @link     Moka_Sweets https://www.mokasweets.com/
 */
namespace App\Http\Controllers\WEB;

use App\Branch;
use App\Cart;
use App\Offer;
use App\Product;
use App\Category;
use Carbon\Carbon;
use App\OfferDetail;
use App\Globals\Utilities;
use Illuminate\Http\Request;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\View;
use App\Http\Resources\OfferCollection;
use App\Http\Controllers\API\OfferController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;
use App\ProductPrice;
use App\ShowCase;
use App\SpecialClass;

/**
 * Redirect The needed views
 *
 * @constructor $request->headers->set('lang', App::getLocale());
 *
 * @category Web
 * @package  Moka_APIs
 * @author   BySwadi <muath.ye@gmail.com>
 * @license  IC https://www.infinitecloud.co
 * @link     Moka_Sweets https://www.mokasweets.com/
 */
class RedirectController extends Controller
{
    /**
     * Handle an incoming request headers.
     *
     * @param Illuminate\Http\Request $request handle requests
     *
     * @bySwadi Added to automatically set lang header
     */
    public function __construct(Request $request)
    {
        $request->headers->set('lang', App::getLocale());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function branches()
    {
        return view(
            '_moka.branches.index',
            ['branches' => Branch::where('status', 1)->get()]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function about()
    {
        return view('_moka.about.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function contactUs()
    {
        return view('_moka.contact-us.index');
    }

    /**
     * Retrieve All product
     * Display a listing of the resource.
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function categories()
    {
        return view('_moka.categories.index');
    }

    /**
     * Retrieve All product
     * Display a listing of the resource.
     *
     * @param Illuminate\Http\Request $request Handle requests
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function products(Request $request)
    {
        ProductPrice::all();

        if (Category::find($request->category_id)) {
            if (Category::where('id', $request->category_id)->where('status', 0)->first()) {
                abort('403');
            }
        }

        $is_most_sell = isset($request->most_sell);
        $is_category = $request->category;

        $categories = new CategoryController();
        $categories = $categories->index($request);

        $all_products = new ProductController();
        $most_sells = $all_products->most_sell($request);
        $products = $all_products->index($request);

        $current_max_price = $request->current_max_price
            ?? ProductPrice::max('price');
        $current_min_price = $request->current_min_price
            ?? ProductPrice::min('price');

        $data = [
            'current_max_price' => $current_max_price,
            'current_min_price' => $current_min_price,
            'max_price' => ProductPrice::max('price'),
            'min_price' => ProductPrice::min('price'),
            'is_most_sell' => $is_most_sell,
            'is_category' => $is_category,
            'categories_list' => $categories,
            'most_sells' => $most_sells,
            'products' => $products,
            'selected_category' => isset($request->category_id) ?
            $request->category_id : '',
            'is_selected_new' => isset($request->is_new) ? 1 : '',
            'pagination_links' => [
                'category_id' =>
                isset($request->category_id) ? $request->category_id : '',
                'is_new' =>
                isset($request->is_new) ? 1 : '',
                'most_sell' =>
                isset($request->most_sell) ? 1 : '',
            ],
        ];

        return view(
            '_moka.categories.products.index', $data
        );
    }

    /**
     * Retrieve product details
     * Display a listing of the resource.
     *
     * @param $request Illuminate\Http\Request
     * @param int $id
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function product(Request $request, $id)
    {
        $product_details = Product::where('id', $id)
            ->with(['category', 'prices', 'favorite'])

            ->has('prices', '>=', 1)
            ->whereHas(
                'prices',
                function ($q) {
                    $q->orderAvailability();
                }
            )
            ->where('status', 1)
            ->available()->ofActiveCategory()
            ->firstOrFail();

        $product_related_collection = new ProductController();
        $product_related = $product_related_collection->related($request, $id);
        // dd($product_details);
        // dd($product_details->prices);
        // dd($product_related);
        return view(
            '_moka.categories.products.details.index',
            compact('product_details', 'product_related')
        );
    }

    /**
     * Retrieve All product
     * Display a listing of the resource.
     *
     * @param $request Illuminate\Http\Request
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function offers(Request $request)
    {
        /**
         * Stopped because offers are shared view
         */

        /* $offer = Offer::orderBy('id', 'desc')->with('offerProduct')->paginate(10);
        return view('_moka.offers.index', compact(new OfferCollection($offer))); */
        return view('_moka.offers.index');
    }

    /**
     * Retrieve product details
     * Display a listing of the resource.
     *
     * @param $request Illuminate\Http\Request
     * @param int $id
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function offer(Request $request, $id)
    {
        /* $offersController = new OfferController();
        $offersDetail = $offersController->show($id);
        $offers = $offersDetail->getData(); */

        // $offersDetail = \App\Offer::where('id', $id)
        //     // ->where('status', 1)
        //     // ->where('start_date', '<=', Carbon::now()->format('Y-m-d'))
        //     // ->where('end_date', '>=', Carbon::now()->format('Y-m-d'))
        //     ->with('offerProduct')->first()->offerProduct;
        //     // dd($offersDetail);
        // $offers = $offersDetail;//->getData();
        // // return $offersDetail;
        // $offer_products = Offer::
        //     where('id', $id)
        //     // ->find($id)
        //     ->with('offerProduct')->get();
        // dd($offer_products);
        // dd($offer_products[0]->offerProduct);

        /** --------------------------------------------------- */
        $offer = Offer::find($id)
            ->where('status', 1)
            ->where('start_date', '<=', Carbon::now()->format('Y-m-d'))
            ->where('end_date', '>=', Carbon::now()->format('Y-m-d'))
            ->with('offerProduct')->first();
            // dd($offer_products->offerProduct);

        $offers = \App\Offer::where('id', $id)
            ->where('status', 1)
            ->where('start_date', '<=', Carbon::now()->format('Y-m-d'))
            ->where('end_date', '>=', Carbon::now()->format('Y-m-d'))
            ->with('offerProduct')->first();

        $offer_products = Offer::
            where('id', $id)
            // ->find($id)
            ->with('offerProduct')
            ->first();
            // dd($offer_products[0]->offerProduct[2]->quantity);
            // TODO: display quantity for each product
        return view(
            '_moka.offers.details.index',
            [
                // 'id' => $id,
                // 'id' => 0,
                'offer' => $offer,
                'offers' => $offers,
                'offer_products' => $offer_products->offerProduct
            ]
        );
    }

    /**
     * Retrieve offer with specified type identifier
     * Display a listing of the offer resource.
     *
     * @param string $type
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function offerType($type)
    {
        $offers = Offer::where('type_id', $type)->get();
        return view(
            '_moka.offers.index', [
            'offerType'=>$offers,
            'current_type' => $type
            ]
        );
    }

    /**
     * Retrieve All product
     * Display a listing of the resource.
     * Used for chanel call
     *
     * @param $request Illuminate\Http\Request
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function mostSell(Request $request)
    {
        $this->products($request);
    }

    /**
     * Privacy policy
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function policy()
    {
        return view('_moka.privacy-policy.index');
    }

    /**
     * Terms of use
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function terms()
    {
        return view('_moka.term-of-use.index');
    }

    /**
     * Sitemap
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function sitemap()
    {
        return view('_moka.sitemap');
    }

    /**
     * Retrieve All Show Cases Categories
     * Display a listing of the resource.
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function showcaseCategories()
    {
        $showcases = SpecialClass::all();
        return view('_moka.samples.categories', ['showcases' => $showcases]);
    }

    /**
     * Retrieve All Show Cases
     * Display a listing of the resource.
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function showcase($showcase)
    {
        $showcases = ShowCase::where('special_class_id' ,$showcase)->get();
        return view('_moka.samples.index', ['showcases' => $showcases]);
    }
}
