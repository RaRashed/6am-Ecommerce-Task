<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $products=Product::all();
        return view('admin.product.index',['categories'=>$categories,'products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $brands= Brand::all();
        return view('admin.product.create',['categories'=>$categories,'brands'=>$brands]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id'=>'required',
            'brand_id' => 'required',
            'price' => 'required',
            'detail' => 'required',
            'images' =>'required'

        ]);

      $product = new Product();
      $product->name =$request->name;
      $product->category_id =$request->category_id;
      $product->brand_id =$request->brand_id;
      $product->quantity =$request->quantity;
      $product->price =$request->price;
      $product->detail =$request->detail;
      $product->save();

       foreach($request->file('images') as $img)
        {

        $imgPath =$img->store('productImages');
        $imgProduct = new ProductImage();
        $imgProduct->product_id = $product->id;
        $imgProduct->prod_image = $imgPath;
       // $imgPath->move(public_path('images'),$imgProduct->prod_image);
        $imgProduct->save();


        }



      return redirect(route('product.create'))->with('success', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        //dd($product->productimages);
       return view('admin.product.show',['product'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
