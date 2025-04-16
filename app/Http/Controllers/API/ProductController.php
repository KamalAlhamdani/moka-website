<?php

namespace App\Http\Controllers\API;

use App\Product;

use App;
use dd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Http\Resources\ProductCollection ;
use App\Http\Resources\Product as ProductResources ;

class ProductController extends Controller
{
    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // BySwadi: check favorite. And Check if user logged in to show his/her favorites
        if(Auth::check()) {
            $products = Product::where('type', "public")
                ->with('prices')
                ->with('category')
                ->ofActiveCategory()
                ->with(['favorite' => function ($hasMany) {
                    $hasMany->where('user_id', auth()->user()->id);
                }])
                //->inRandomOrder() //get logic fault in pagination
                ->ofSearch($request)
                ->ofCategory($request)
                ->isNew($request)
                ->available()
                // ->has('prices', '>=', 1)
                ->whereHas(
                    'prices',
                    function ($q) {
                        // if the admin did not add image for product price,
                        // this will not appear.
                        $q->whereNotNull('image');
                    }
                )
                ->paginate(10);
        } else {
            $products = Product::where('type', "public")
                ->with('prices')
                ->with('category')
                //->inRandomOrder() //get logic fault in pagination
                ->ofSearch($request)
                ->ofCategory($request)
                ->ofActiveCategory()
                ->isNew($request)
                ->available()
                // ->has('prices', '>=', 1)
                ->whereHas(
                    'prices',
                    function ($q) {
                        // if the admin did not add image for product price,
                        // this will not appear.
                        $q->whereNotNull('image');
                    }
                )
                ->paginate(10);
        }

        return new ProductCollection($products);
    }

    public function new(Request $request)
    {
        $products = Product::where('type',"public")->with(['favorite' => function ($hasMany) {
            $hasMany->where('user_id', auth()->user()->id);
        }])->New()->available()->ofActiveCategory()->paginate(10);
        return new ProductCollection( $products);

        return response()->json(['success'=>true,'data'=>  $products], $this-> successStatus);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function most_sell(Request $request)
    {
        // TODO: if needed retrieve the product with its price which most sell if have more prices
        //$products = Product::withCount('cartDetail')->orderBy('cart_detail_count','desc')->paginate(10);
        //return new ProductCollection( $products);

        return new ProductCollection(Product::available()->ofActiveCategory()->get() ); //by sasa
        // TODO: fix most sell product
//        $products = Product::withCount('cartDetail')->orderBy('cart_detail_count','desc')->paginate(10);
//        return new ProductCollection( $products);
//
//        return response()->json(['success'=>true,'data'=> $products], $this-> successStatus);

    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function related(Request $request,$id)
    {

        $product = Product::findOrFail($id);
        $products = Product::where('type',"public")->where('category_id',$product->category_id)->with('prices')->inRandomOrder()->ofSearch($request)->ofActiveCategory()->available()->paginate(10);

        return new ProductCollection($products);

      //  return response()->json(['success'=>true,"data"=> $d], $this-> successStatus);
    }


     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::where('id', $id)
            ->where('type', "public")
            ->with('prices')
            ->with(
                [
                    'favorite' => function ($hasMany) {
                        $hasMany->where('user_id', Auth::user()->id);
                    }
                ]
            )->available()->ofActiveCategory()->firstOrFail();

        // If there is no products, empty array will return.
        if ($products == null) {
            return response()->json(
                ['success'=>true,'data'=>  []], $this->successStatus
            );
        }
        return new ProductResources($products);

        return response()->json(
            ['success'=>true,'data'=>  $products], $this->successStatus
        );
    }



    // public function favorite(Request $request)
    // {
    //     $user = Auth::user();
    //     $products = Product::where('type',"public")->with('favorite')->paginate(10);
    //     return response()->json(['success'=>true,'data'=>  $products], $this-> successStatus);
    // }
}
