<?php

namespace App\Http\Controllers\API;

use App\category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Http\Resources\ProductCollection ;

class CategoryController extends Controller
{
    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //TODO: [BySwadi] use domainAsset() 
        //to return full path instead of path in directory
        // current: 'storage/categorise/ArabicCookiesxxxhdpi.png'
        // future:  'http://moka.cp/storage/categorise/ArabicCookiesxxxhdpi.png'
        $categories = Category::where('status', 1)->get();
        return response()->json(['success'=>true,'data'=> $categories], $this-> successStatus);
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
    public function show(Request $request,$id)
    {
        $data = Category::find($id)->product()->with(['favorite' => function ($hasMany) {
            $hasMany->where('user_id', auth()->user()->id);
        }])->paginate(10);
        return new ProductCollection( $data);
        return response()->json(['success'=>true,'data'=> $data], $this-> successStatus);
    }
}
