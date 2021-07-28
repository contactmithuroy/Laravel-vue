<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class PublicAPIController extends Controller
{
    public function getProduct(){
        $products = Product::with('category')->latest()->paginate(20);
        return response()->json($products,200);
    }
}
