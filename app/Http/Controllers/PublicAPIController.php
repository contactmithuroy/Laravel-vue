<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class PublicAPIController extends Controller
{
    public function getProduct(){
        $products = Product::with('category')->latest()->paginate(15);
        return response()->json($products,200);
    }
    public function searchData($search){ 
        $products = Product::with('category')->where('title','LIKE','%'.$search.'%')->get();
        return response()->json($products,200);
    }
    public function clickSearch($search){ 
        $products = Product::with('category')->where('title','LIKE','%'.$search.'%')->get();
        return response()->json($products,200);
    }
}
