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
        $products = Product::with('category')->latest()->get();
        return response()->json($products,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status',1)->latest()->get();
        return response()->json($categories,200);
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
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->description = $request->description;
        // $product->user = Auth::user()->id;
        $product->user = 1;
        $product->slug = Str::slug($request->title,'-');
        if(Product::whereSlug($product->slug)->exists()){
            $product->slug = "{$product->slug}_".rand(0,500);
        }
        if((($request->status) == '') || (($request->status) == false) || (($request->status) == 0) ){
            $product->status =0;  
        }else{
            $product->status =1; 
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
        $categories = Category::where('status',1)->latest()->get();
        return response()->json([$product,$categories,200]);
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
        // return response()->json(['success','product'=>$request->all(),200]);
        // die();
        $this->validate($request,[
            'title'=>'required|max:255',
            'category_id'=>'required',
            'price'=>'required|integer',
            // 'image'=>'sometime|nullable|image|max:2048',
            'description'=>'required',
        ]);

        $product->title = $request->title;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->description = $request->description;
        // $product->user = Auth::user()->id;
        $product->user = 1;
        $product->slug = Str::slug($request->title,'-');
        if(Product::whereSlug($product->slug)->exists()){
            $product->slug = "{$product->slug}_".rand(0,500);
        }
        if( (isset($request->status)) ){
            $product->status =1;
        }else{
            $product->status =0; 
        }

        if($request->image){
            if(file_exists(public_path($product->image))){ //if have this type of path has exiting
                unlink(public_path("{$product->image}")); // have exiting then delete this file
            }
            $imageName = time().'-'.uniqid().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage/product/'),$imageName);
            $product->image = '/storage/product/'.$imageName;
        }
        $product->save();
        return response()->json(['success','product'=>$product,'status'=>$request->status,200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product){
            if(file_exists(public_path($product->image))){ //if have this type of path has exiting
                unlink(public_path("{$product->image}")); // have exiting then delete this file
            }
            $product->delete();
            return response()->json('success',200);
        }else{
            return response()->json('failed',404);
        }
    }
}
