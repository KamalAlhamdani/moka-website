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

namespace App\Http\Controllers\Web;


use App\Product;
use App\Request as RequestModel;
use App\TasteTranslation;
use App\UnitTranslation;
use App\UserFavorite;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProductCollection;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\FavoriteController;

/**
 * Home Page Class
 *
 * @constructor $request->headers->set('lang', App::getLocale());
 *
 * @category Web
 * @package  Moka_APIs
 * @author   BySwadi <muath.ye@gmail.com>
 * @license  IC https://www.infinitecloud.co
 * @link     Moka_Sweets https://www.mokasweets.com/
 */
class HomeController extends Controller
{
    private $userName = 'moka_api';
    private $password = '974.1145.101.64';

    /**
     * Handle an incoming request headers.
     * Added to automatically set lang header
     *
     * @param $request Illuminate\Http\Request
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $request->headers->set('lang', App::getLocale());
    }

    /**
     * Display a listing of the resource.
     *
     * @param $request Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //You should login to send a request
        if (Auth::check()) {

            $new = new ProductController();
            $new_products = $new->new($request);
            // the second return is working
            $most_products = $new->most_sell($request);
            $some_products = new ProductCollection(
                Product::inRandomOrder()
                    ->has('prices', '>=', 1)
                    ->whereHas(
                        'prices',
                        function ($q) {
                            $q->orderAvailability();
                        }
                    )
                    ->where('status', 1)
                    ->available()->ofActiveCategory()
                    ->get()
            );
            // $some_products = new ProductCollection(Product::get());
            return view(
                '_moka.home.index',
                compact(
                    'new_products',
                    'most_products',
                    'some_products'
                )
            );
        }
        $new_products = new ProductCollection(
            Product::where('type', "public")->New()
                ->has('prices', '>=', 1)
                ->whereHas(
                    'prices',
                    function ($q) {
                        $q->orderAvailability();
                    }
                )
                ->where('status', 1)
                ->available()->ofActiveCategory()
                ->paginate(10)
        );
        // TODO: fix most sell [It now return all products]
        $most_products = new ProductCollection(Product::get());
        $some_products = new ProductCollection(
            Product::inRandomOrder()
                ->has('prices', '>=', 1)
                ->whereHas(
                    'prices',
                    function ($q) {
                        $q->orderAvailability();
                    }
                )
                ->where('status', 1)
                ->available()->ofActiveCategory()
                ->get()
        );
        return view(
            '_moka.home.index',
            compact(
                'new_products',
                'most_products',
                'some_products'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $request \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $id int
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id int
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $request Illuminate\Http\Request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id int
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Store new favorite product.
     *
     * @param $request \Illuminate\Http\Request
     *
     * @return Redirect Illuminate\Support\Facades\Redirect
     */
    public function favoritePost(Request $request)
    {
        // dd(request()->all());
        // $favorite = new FavoriteController();
        // $favorite->store($request);

        $input = $request->all();

        $validator = Validator::make(
            $input, [
                'product_id' => 'required|exists:products,id',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        $user = Auth::user();

        $user_favorite = UserFavorite::firstOrCreate(
            [
                'user_id' => $user->id, 'product_id' => $input["product_id"]
            ]
        );

        return Redirect()->back();
    }

    /**
     * Remove a product from favorite.
     *
     * @param int $product_id product identifier
     *
     * @return Redirect Illuminate\Support\Facades\Redirect
     */
    public function favoriteDel($product_id)
    {
        $favorite = new FavoriteController();
        $favorite->destroy($product_id);
        return Redirect()->back();
    }

    /**
     * Search Products
     *
     * @param Illuminate\Http\Request $request file name in outside project
     *
     * @return App\Http\Resources\ProductCollection
     */
    /* public function search(Request $request) */
    public function search(Request $search)
    {
        // BySwadi: check favorite. And Check if user logged in to show his/her favorites
        if (Auth::check()) {
            $products = Product::where('type', "public")
                ->with('prices')
                ->with('category')
                ->with(['favorite' => function ($hasMany) {
                    $hasMany->where('user_id', auth()->user()->id);
                }])
                //->inRandomOrder() //get logic fault in pagination
                ->ofSearch($search)
                ->ofCategory($search)
                ->isNew($search)
                ->available()
                ->paginate(10);
        } else {
            $products = Product::where('type', "public")
                ->with('prices')
                ->with('category')
                //->inRandomOrder() //get logic fault in pagination
                ->ofSearch($search)
                ->ofCategory($search)
                ->isNew($search)
                ->available()
                ->paginate(10);
        }

        return new \App\Http\Resources\ProductCollection($products);
    }

    /**
     * Test custom helper method
     *
     * @param string $file file name in outside project
     * @param string $domain domain name of that project
     *
     * @return void
     */
    public function testme($file, $domain)
    {
        asset();
    }


    public function SendPayment()
    {

        $SCustID = request('SCustID');
        $REFNO = rand(999, 9999);
        $AMOUNT = request('AMOUNT');
        $PINPASS = request('PINPASS');

        $url = "https://213.202.4.205:12147/PHEPaymentAPI/EPayment/SendPayment";
        // $data = '{"SCustID":'.$SCustID.',"REFNO":'.$REFNO.',"AMOUNT":'.$AMOUNT.',"CRCY":"YER","MRCHNTNAME":"Merchant 1","PINPASS":'.$PINPASS.'}';
        $data = '{
    "SCustID": "' . $SCustID . '",
    "REFNO": "' . $REFNO . '",
    "AMOUNT": ' . $AMOUNT . ',
    "CRCY":"YER" ,
    "MRCHNTNAME": "Merchant 1",
    "PINPASS": "' . base64_encode($PINPASS) . '"
}';
        $auth_code = 'U3VwcGxpZXIyMDIxOkFkbWluMTIz';

        $resp = $this->sendCurl($url, $auth_code, $data);
        return [$resp];
    }

    public function ReversePayment()
    {

        $SCustID = request('SCustID');
        $REFNO = request('REFNO');

        $url = "https://213.202.4.205:12147/PHEPaymentAPI/EPayment/ReversePayment";
        $data = '{"SCustID":' . $SCustID . ',"REFNO":' . $REFNO . '}';
        $auth_code = 'U3VwcGxpZXIyMDIxOkFkbWluMTIz';

        $resp = $this->sendCurl($url, $auth_code, $data);
        return [$resp];
    }

    public function verify()
    {

        $CustomerZone = request('CustomerZone');
        $MobileNo = request('MobileNo');
//        $Email = request('Email');
        $message = 'تفاصيل العميل غيري صالحة';
        $message_en = 'Invalid customer details';
        $code = 0;
        if (strlen($MobileNo) <= 0) {
            $code = 2;
            $message = 'رقم الموبايل  إلزامي';
            $message_en = 'Mobile number is required.';
        }
        if (strlen($CustomerZone) <= 0) {
            $code = 2;
            $message = 'كود المنطقة إلزامي';
            $message_en = 'Zone Code is required.';
        }

        switch ($CustomerZone) {
            case 'YE0012003':
            case 'YE0012004':
            case 'YE0012005':
                break;
            default:
                $code = 2;
                $message = 'المنطقة غير مقبولة';
                $message_en = 'Zone note accepted.';
        }
//        if(($CustomerZone!='YE0012003'&&$CustomerZone!='YE0012004' && $CustomerZone!='YE0012005')){
//            $code=2;
//            $message = 'المنطقة غير مقبولة';
//            $message_en = 'Zone note accepted.';
//        }

        if ($code == 0) {
            $user = User::where('phone', '=', $MobileNo)->first();
            if ($user) {
                $code = 1;
            }
        }

        if ($code == 1) {
            return [
                'Code' => 1,
                'SCustID' => $MobileNo,
                'DescriptionAr' => 'تم التحقق من تفاصيل العميل بنجاح',
                'DescriptionEn' => 'Customer details verified successfully',
            ];
        } else {
            return [
                'Code' => 2,
                'SCustID' => null,
                'DescriptionAr' => $message,
                'DescriptionEn' => $message_en,
            ];
        }

    }

    public function getOrdersForInnerSystem()
    {
        return $requests = RequestModel::with(['carrier', 'deliveryPriceings', 'branch', 'address', 'payment', 'requestItems.cartProductItemsSys.product'])->where('status', '=', 'forsys')->get();
    }

    public function getAllOrdersForInnerSystemObject()
    {
        $page = request('page');
        $limit = request('limit');

        if($limit==null){
            $limit=10;
        }

        if($page>0){
            $offset = ($page-1)*$limit;
        }else{
            $offset = 0;
        }


        $requests = RequestModel::with(['carrier', 'deliveryPriceings', 'branch', 'address', 'payment', 'requestItems.cartProductItemsSys.product'])->where('status', '=', 'delivered')->offset($offset)->limit($limit)->orderBy('updated_at','desc')->get();
        $objects = [];
        foreach ($requests as $request) {
//        if($request->id=88463)
//            dd($request);
            $data['request_id'] = $request->id;
            $data['request_number'] = $request->request_number;
            $data['carrier_id'] = $request->carrier->id;
            $data['carrier_name'] = $request->carrier->name;
            $data['sale_place'] = $request->carrier->name;
            $data['store'] = $request->carrier->name;
            $data['branch'] = $request->carrier->name;
            $data['client_id'] = $request->requestItems->user->id;
            $data['client_mobile'] = $request->requestItems->user->phone;
            $data['client_name'] = $request->requestItems->user->name;
            $data['client_address_desc'] = $request->address->desc;
            $data['client_address_lat'] = $request->address->lat;
            $data['client_address_long'] = $request->address->long;
            $data['client_address_geolocation'] = $request->address->lat . ',' . $request->address->long;
            $items = [];
            foreach ($request->requestItems->cartProductItems as $item) {
                $product['product_id'] = $item->id;
                $product_object = Product::where('id', $item->product_id)->first();
                $product['product_number'] = $product_object->number;
                $product['product_system_number'] = $product_object->system_number;
                $product['product_bar_code'] = $product_object->bar_code;
                $product['product_quantity'] = $item->pivot->quantity;
                $product['product_price'] = $item->price;

                $price = $item->price;
                $product_discount_id = $item->pivot->product_discount_id;
                $product_discount = $item->pivot->productDiscount;
                $discount_value = 0;

                if (!is_null($product_discount_id) && $item->pivot->product_price_id == $product_discount->product_price_id) {
                    $discount = $product_discount->value;
                    $price = ($product_discount->value_type == 'percentage') ? $price - (($discount / 100) * $price) : max(($price - $discount), 0);
                    $discount_value = ($product_discount->value_type == 'percentage') ? (($discount / 100) * $price) : max($discount, 0);
                }
                $product['product_total_price'] = $price * $item->pivot->quantity;
                $product['product_discount_price'] = $discount_value * $item->pivot->quantity;

//            $product['product_total_price'] = $item->pivot->quantity*$item->price;
                $product['product_unit_id'] = UnitTranslation::where('unit_id', $item->unit_id)->first()->name;
                $product['product_taste_id'] = TasteTranslation::where('taste_id', $item->taste_id)->first()->taste;
                $items[] = $product;
            }
            $data['request_items'] = $items;
            $data['request_items_total'] = $request->requestItems->price_sum;
            $data['request_desc'] = $request->note;
            $data['request_delivery_date'] = null;
            $data['order_date'] = $request->created_at;
            $objects[] = $data;
        }
        $return_objects['data'] = $objects;
        $return_objects['count'] = RequestModel::where('status', '=', 'delivered')->count();
        $return_objects['page'] = $page;
        $return_objects['limit'] = $limit;
        $return_objects['offset'] = $offset;
        $return_objects['success'] = true;
        $return_objects['status'] = 200;
        $return_objects['message'] = 'success';
        $return_objects['next_page'] = $page+1;
        $return_objects['prev_page'] = $page-1;
        $return_objects['total_pages'] = ceil($return_objects['count']/$limit);
        $return_objects['current_base_url'] = request()->url();
        $return_objects['current_url'] = request()->fullUrl();
        $return_objects['next_page_url'] = $return_objects['current_base_url'].'?page='.$return_objects['next_page'].'&limit='.$limit;
        $return_objects['prev_page_url'] = $return_objects['current_base_url'].'?page='.$return_objects['prev_page'].'&limit='.$limit;
        return $return_objects;
    }


    public function getOrdersForInnerSystemObject()
    {

        $requests = RequestModel::with(['carrier', 'deliveryPriceings', 'branch', 'address', 'payment', 'requestItems.cartProductItemsSys.product'])->where('status', '=', 'forsys')->get();
        $objects = [];
        foreach ($requests as $request) {
//        if($request->id=88463)
//            dd($request);
            $data['request_id'] = $request->id;
            $data['request_number'] = $request->request_number;
            $data['carrier_id'] = $request->carrier->id;
            $data['carrier_name'] = $request->carrier->name;
            $data['sale_place'] = $request->carrier->name;
            $data['store'] = $request->carrier->name;
            $data['branch'] = $request->carrier->name;
            $data['client_id'] = $request->requestItems->user->id;
            $data['client_mobile'] = $request->requestItems->user->phone;
            $data['client_name'] = $request->requestItems->user->name;
            $data['client_address_desc'] = $request->address->desc;
            $data['client_address_lat'] = $request->address->lat;
            $data['client_address_long'] = $request->address->long;
            $data['client_address_geolocation'] = $request->address->lat . ',' . $request->address->long;
            $items = [];
            foreach ($request->requestItems->cartProductItems as $item) {
                $product['product_id'] = $item->id;
                $product['product_number'] = Product::where('id', $item->product_id)->first()->number;
                $product['product_quantity'] = $item->pivot->quantity;
                $product['product_price'] = $item->price;

                $price = $item->price;
                $product_discount_id = $item->pivot->product_discount_id;
                $product_discount = $item->pivot->productDiscount;

                if (!is_null($product_discount_id) && $item->pivot->product_price_id == $product_discount->product_price_id) {
                    $discount = $product_discount->value;
                    $price = ($product_discount->value_type == 'percentage') ? $price - (($discount / 100) * $price) : max(($price - $discount), 0);
                }
                $product['product_total_price'] = $price * $item->pivot->quantity;

//            $product['product_total_price'] = $item->pivot->quantity*$item->price;
                $product['product_unit_id'] = UnitTranslation::where('unit_id', $item->unit_id)->first()->name;
                $product['product_taste_id'] = TasteTranslation::where('taste_id', $item->taste_id)->first()->taste;
                $items[] = $product;
            }
            $data['request_items'] = $items;
            $data['request_items_total'] = $request->requestItems->price_sum;
            $data['request_desc'] = $request->note;
            $data['request_delivery_date'] = null;
            $data['order_date'] = $request->created_at;
            $objects[] = $data;
        }
        return $objects;
    }

    public function TadamonSendPayment()
    {

        $url = "https://mahtest.tadhamonbank.com:7006/AgentWs/resources/Agent/agentApiRequest";
        $url = "https://agentapi.tadhamonbank.com/AgentWs/resources/Agent/agentApiRequest";

        $fromAccount = request('fromAccount');
        $trans_type = 'pos';
        $amount = request('amount');


        $data = '{
    "userName": "' . $this->userName . '",
    "password": "' . $this->password . '",
    "fromAccount": "' . $fromAccount . '",
    "trans_type": "' . $trans_type . '",
    "amount": ' . $amount . ',
}';
        $auth_code = '';

        $resp = $this->sendCurl($url, $auth_code, $data);
        return [$resp];
    }

    public function TadamonConfirmPayment()
    {


        $url = "https://mahtest.tadhamonbank.com:7006/AgentWs/resources/Agent/agentApiConfirmRequest";
        $url = "https://agentapi.tadhamonbank.com/AgentWs/resources/Agent/agentApiConfirmRequest";


        $transId = request('transId');
        $trans_type = 'pos';
        $otp = request('otp');
        $data = '{
    "userName": "' . $this->userName . '",
    "password": "' . $this->password . '",
    "transId": "' . $transId . '",
    "trans_type": "' . $trans_type . '",
    "otp": ' . $otp . ',
}';
        $auth_code = '';

        $resp = $this->sendCurl($url, $auth_code, $data);
        return [$resp];
    }

    public function TadamonStatus()
    {

        $url = "https://agentapi.tadhamonbank.com/AgentWs/resources/Agent/agentApiStatus";


        $transId = request('transId');


        $data = '{
    "userName": "' . $this->userName . '",
    "password": "' . $this->password . '",
    "transId": "' . $transId . '",
}';
        $auth_code = '';

        $resp = $this->sendCurl($url, $auth_code, $data);
        return [$resp];
    }


    /**
     * @param string $url
     * @param string $auth_code
     * @param string $data
     * @return bool|string
     */
    public function sendCurl(string $url, string $auth_code, string $data)
    {

        $username = 'MOK01_UAT';
        $password = 'MOK@007';
//         $curl = curl_init($url);
//         curl_setopt($curl, CURLOPT_URL, $url);
//         curl_setopt($curl, CURLOPT_POST, true);
//         curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $password);
//         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//         $headers = array(
//             "Content-Type: application/json",
//             "Authorization: Basic ".base64_encode("$username:$password"),
//         );
//         curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

// //        $data = '{"Username":"Supplier2021","Password":"Admin123"}';


//         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

// //for debug only!
//         curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
//         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

//         $resp = curl_exec($curl);
//         curl_close($curl);
//         return $resp;


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                ($auth_code != '') ? 'Authorization: Basic TU9LMDFfVUFUOk1PS0AwMDc=' : '',
                'Content-Type: application/json'
            ),
        ));
        print_r($data);
        print_r($url);

        $response = curl_exec($curl);
        $str = '';
        if (curl_error($curl)) {
            $str = curl_error($curl);
            $info = curl_getinfo($curl);
            $str .= json_encode($info);
        }

        curl_close($curl);
        if (strlen($str)) {
            return $str;
        }
        return $response;


    }
}
