<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;

use App\User;
use App\PointHistory;
use App\BalanceTransaction;
use App\userWallet;
use App\PointPrice;

use Carbon\Carbon;


use App\Http\Resources\PointHistoryResource ;


class PointHistoryController extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $balance_transaction;
        if($user->wallet)
        {
            $balance_transaction =  $user->wallet->walletTransaction()
            ->where('type','add_from_point')->orderBy('created_at','desc')->first();
        }
       // print_r($balance_transaction);
      //  die;

        $last_convert_date = $user->created_at ;
        if(isset( $balance_transaction['created_at']))
        {

            $last_convert_date =  $balance_transaction['created_at'];
            //die($last_convert_date);
        }

        $data = $user->pointHistory()
        ->where('created_at','>=',$last_convert_date)->orderBy("id","desc")->get();

        return  PointHistoryResource::collection( $data);


       //return response()->json(['success'=>true,'data'=> $data], $this-> successStatus);

    }



     /**
     * Display a listing of the sum of types points resource.
     * TODO: if needed monthly share
     *
     * @return \Illuminate\Http\Response
     */
    public function monthly_point_add()
    {
        $user = Auth::user();
         $data['point'] = 0;
         
        //check if there is no points added for sharing in  the last month
        $count = $user->pointHistory()->whereRaw('MONTH(point_histories.created_at) = MONTH(NOW())')->whereIn('gain_method_id',function ($query)  {
            $query->select('id')->from('gain_methods')
            ->where('gain_type_id',3);

        })->count()  ;
        if($count==0)
        {
                //check and add point for monthly sharing
                $gain_types =  \App\GainMethod::where('gain_type_id',3)->orderBy("required_min_price","DESC")->get();


                foreach ($gain_types as $gain_type) {

                    if( $user->monthly_share >=  $gain_type['required_min_price'] )
                    {
                        $input = [ 'user_id'=>$user->id ,"gain_method_id" => $gain_type['id'],'price'=>$gain_type['price']];
                        $point = PointHistory::create($input);
                        $data['point'] = $point->price;
                        break;
                    }
                }
                $user->monthly_share = 0;
                $user->save();
        }

        //sum the price of purchases in the last month
        $user_last_month_purchased = $user->request()->Active()->orderBy("id","desc")->whereRaw('MONTH(requests.created_at) = MONTH(NOW())-1')->get()->groupBy(function($val) {
                 return Carbon::parse($val->created_at)->format('m');
        })->map(function($item, $key){

            $sum = $item->sum(function ($product) {
                return $product['RequestItems']['price_sum'];
            });
            return $sum;
        });

        dd($user_last_month_purchased);
        dd(Carbon::now()->subMonth(1)->format('m'));
        $user_last_month_purchased =   $user_last_month_purchased[Carbon::now()->subMonth(1)->format('m')];

        dd('ddskfjlsdhkjfahjkdjkflsdjfksjdklj');
        $gain_types =  \App\GainMethod::where('gain_type_id',5)->orderBy("required_min_price","DESC")->get();

        //check if there is no points added for the last month
       $count = $user->pointHistory()->whereRaw('MONTH(point_histories.created_at) = MONTH(NOW())')->whereIn('gain_method_id',function ($query)  {
            $query->select('id')->from('gain_methods')
            ->where('gain_type_id',5);

        })->count()  ;
        if($count==0)
        {
            foreach ($gain_types as $gain_type) {

                if(  $user_last_month_purchased >=  $gain_type['required_min_price'] )
                {
                    $input = [ 'user_id'=>$user->id ,"gain_method_id" => $gain_type['id'],'price'=>$gain_type['price']];
                    $point = PointHistory::create($input);
                    $data['point'] += $point->price;
                    break;
                }
            }
        }


    //check if there is no points added for the last month
    $count = $user->pointHistory()->whereRaw('MONTH(point_histories.created_at) = MONTH(NOW())')->whereIn('gain_method_id',function ($query)  {
    $query->select('id')->from('gain_methods')
    ->where('gain_type_id',4);
     })->count();

    if($count == 0)
    {
        $points = $this->child_point($user->points_account_num);
        $gain_type =  \App\GainMethod::where('gain_type_id',4)->orderBy("id","DESC")->first();
       // die($points .'');
        $input = [ 'user_id'=>$user->id ,"gain_method_id" => $gain_type['id'],'price'=> $gain_type['required_percentage']*$points];
        $point = PointHistory::create($input);
        $data['point'] += $point->price ;
    }

       /*  foreach ($gain_types as $gain_type) {


        } */


        return response()->json(['success'=>true,'data'=> $data], $this-> successStatus);

    }


    private function child_point($point_id) : int
    {
        $users = User::where('parent_points_account_num',$point_id)->get();
        $points = 0;
        foreach ($users as $key => $user) {

           // dd($users);
            $user_point = $user->pointHistory()
            ->whereRaw('MONTH(point_histories.created_at) = MONTH(NOW())-1')->get()
            ->groupBy(Auth::getDefaultDriver()=="api"?'user_id':'carrier_id')->map(function($item, $key){

                $sum = $item->sum(function ($product) {
                    return $product['price'];
                });

                return $sum;
            });

            $points += isset($user_point[$user->id])?$user_point[$user->id]:0;

            $points +=  $this->child_point($user->points_account_num);

        }

        return $points;
    }

    /**
     * Display a listing of the sum of types points resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sum()
    {
        $user = Auth::user();


        $balance_transaction;
        if($user->wallet)
        {
            $balance_transaction =  $user->wallet->walletTransaction()
            ->where('type','add_from_point')->orderBy('created_at','desc')->first();
        }

       // print_r($balance_transaction);
      //  die;

        $last_convert_date = Carbon::now() ;
        if(isset( $balance_transaction['created_at']))
        {

            $last_convert_date =  $balance_transaction['created_at'];
            //die($last_convert_date);
        }

        $data = $user->pointHistory()
        ->where('created_at',isset( $balance_transaction['created_at'])?'>=':'<=',$last_convert_date)->get()
        ->groupBy('GainMethod.GainType.name')->map(function($item, $key){

            $sum = $item->sum(function ($product) {
                return $product['price'];
            });
            return $sum;
        });


        return response()->json(['success'=>true,'data'=> $data], $this-> successStatus);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function convert(Request $request)
    {
        $user = Auth::user();

       // die(Auth::getDefaultDriver());

       // $balance_transaction = BalanceTransaction::where('user_id',$user->id)->first();
        $wallet = $user->wallet;
// dd($user, $wallet);
        $balance_transaction;
        if($wallet)
        {
            $balance_transaction =  $wallet->walletTransaction()
            ->where('type','add_from_point')->orderBy('created_at','desc')->first();
        }


        $last_convert_date = Carbon::now() ;
        if(isset( $balance_transaction['created_at']))
        {
            $last_convert_date =  $balance_transaction['created_at'];
        }

        $points = $user->pointHistory()
        ->where('created_at',isset( $balance_transaction['created_at'])?'>':'<',$last_convert_date)->get()
        ->groupBy(Auth::getDefaultDriver()=="api"?'user_id':'carrier_id')->map(function($item, $key){

            $sum = $item->sum(function ($product) {
                return $product['price'];
            });

            return $sum;
        });

        $total_point_price=0;
        $total_points=0;

        if(isset($points[$user->id]))
        {
            $total_points =  $points[$user->id];
            $point_price = PointPrice::orderBy('id','desc')->first();

            $total_point_price = $point_price->price * $total_points;
            if(isset($request['confirm']) &&  $request['confirm'] == true)
            {
                if(is_null($wallet))
                {


                    if( Auth::getDefaultDriver()=="api")
                    $wallet = userWallet::create([
                      'user_id' => $user->id,
                      'current_balance' =>  $total_point_price,
                      'openning_balance' =>  $total_point_price,
                      'type' => "add_from_point"
                    ]);
                    else {

                        $wallet = userWallet::create([
                            'carrier_id' => $user->id,
                              'current_balance' =>  $total_point_price,
                              'openning_balance' =>  $total_point_price,
                              'type' => "add_from_point"
                          ]);

                    }
                }
                else
                {
                    $wallet->current_balance =   $wallet->current_balance  + $total_point_price ;
                    $wallet->save();
                }


                BalanceTransaction::create([
                    'user_wallet_id' => $wallet->id,
                    'amount' =>  $total_point_price,
                    'type' => "add_from_point"
                ]);

            }





        }

       $data =  ['total_converted_point' => $total_points,'total_point_price' => $total_point_price,
             'total_user_balance'=> $wallet->current_balance??0];

        return response()->json(['success'=>true,'data'=> $data], $this-> successStatus);

    }

    public function convertList()
    {
        $user = Auth::user();

       // $balance_transaction = BalanceTransaction::where('user_id',$user->id)->first();
       $balance_transaction=[];
       if($user->wallet)
       {
           $balance_transaction =  $user->wallet->walletTransaction()
           ->where('type','add_from_point')->orderBy('created_at','desc')->get();
       }

       // print_r($balance_transaction);
      //  die;
        //$first_convert_date = $user->created_at ;
      foreach ($balance_transaction as $key => $value) {
          //die($key);
            $data = $user->pointHistory()

            ->where('created_at','<',$value['created_at'])
            ->where('created_at','',$balance_transaction[$key+1]['created_at']??$user->created_at)

            ->get()->groupBy(Auth::getDefaultDriver()=="api"?'user_id':'carrier_id')->map(function($item, $key){

                $sum = $item->sum(function ($product) {
                    return $product['price'];
                });
            // var_dump($sum);
                //die;
                return $sum;
            });
           // return response()->json(['success'=>true,'data'=> $balance_transaction], $this-> successStatus);

           // $first_convert_date = $value['created_at'];

            $balance_transaction[$key]->point = isset($data[$user->id]) ? $data[$user->id] : 0;
      }


        //$point_Sum =  $data[$user->id];

        return response()->json(['success'=>true,'data'=> $balance_transaction], $this-> successStatus);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
