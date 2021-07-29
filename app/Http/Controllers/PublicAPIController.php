<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class PublicAPIController extends Controller
{
    public function getProduct(){
        $products = Product::with('category')->paginate(15);
        return response()->json($products,200);
    }
    public function searchData($search){ 
        $products = Product::with('category')->where('title','LIKE','%'.$search.'%')->get();
        return response()->json($products,200);
    }
    public function getSortValue(){ 

        $sort_direction = request('sort_direction','desc');
        $sort_field = request('sort_field','created_at');
        
        if(!in_array($sort_direction,['ASC','DESC'])){
            $sort_direction = 'DESC';
        }
        if(!in_array($sort_field,['title','id','price'])){
            $sort_field = 'created_at';
        }

        $products = Product::with('category')
        ->orderBy($sort_field,$sort_direction)
        ->get();
        return response()->json($products,200);
    }
}
