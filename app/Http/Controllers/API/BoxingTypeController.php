<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BoxingType;

class BoxingTypeController extends Controller
{
    public $successStatus = 200;
    public function Index(Request $request)
    {
        $boxingType = BoxingType::all();
        return response()->json(['success'=>true,'data'=> $boxingType], $this-> successStatus);

    }
}
