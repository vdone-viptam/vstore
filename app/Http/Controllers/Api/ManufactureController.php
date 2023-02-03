<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ManufactureController extends Controller
{
    public function index(Request $request){
        $limit = $request->limit ?? 10;
        $user = User::paginate($limit);
        return response()->json([
            'status_code' => 200,
            'data' => $user,

        ]);
    }
    public function detail(Request $request,$id){
        $user = User::find($id);
        return response()->json([
            'status_code' => 200,
            'data' => $user,

        ]);
    }
}
