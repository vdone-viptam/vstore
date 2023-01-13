<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::paginate(10);
        return response()->json([
            'status_code' => 200,
            'data' => $categories
        ]);
    }
}
