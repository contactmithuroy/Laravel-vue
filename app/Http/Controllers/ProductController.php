<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return response()->json($products,200);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|max:255',
            'category_id'=>'required',
            'price'=>'required|integer',
            // 'image'=>'required|image|max:2048',
            'description'=>'required',
        ]);

        $product = new Product();
        $product->title = $request->title;
        $product->category_id = 1;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->image = 'image';
        // $product->user = Auth::user()->id;
        $product->user = 1;
        $product->slug = Str::slug($request->title,'-');
        if(Product::whereSlug($product->slug)->exists()){
            $product->slug = "{$product->slug}_".rand(0,500);
        }
        if(($request->status) == true){
            $product->status =1;  
        }else{
            $category->status =0; 
        }
        if($request->image){
            $imageName = time().'-'.uniqid().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage/product/'),$imageName);
            $product->image = '/storage/product/'.$imageName;
        }
        $product->save();
        return response()->json(['success','product'=>$product,200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
