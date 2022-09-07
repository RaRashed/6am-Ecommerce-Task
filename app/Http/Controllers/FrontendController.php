<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Product;
use Illuminate\Contracts\Session\Session as SessionSession;
use Session;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    protected $product;
    protected $coupon;
    public function __construct(Product $product, Coupon $coupon)
    {
        $this->product=$product;
        $this->coupon=$coupon;

    }

    public function index()
    {
        $products =$this->product::all();
        return view('frontend.index',['products' => $products]);
    }
    public function cart()
    {
        return view('frontend.cart');
    }
    public function addToCart($id)
    {
        $product = $this->product::find($id);

        if(!$product) {

            abort(404);

        }

        $cart = session()->get('cart');





        // cart  increment quantity
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "photo" => $product->photo
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


    public function applyCoupon(Request $request)

    {
       $oldCart = Session::get('cart');
       //dd($oldCart);
       $coupon =Session::get('coupon');
       //dd($coupon);
       $coupon = Coupon::where('name', $request->coupon)->first();


       if(!$coupon){
           return redirect()->back()->with('fail', 'Coupon Code Not Found');
       }
       $coupons =[
        'name' => $coupon->name,
        'id' => $coupon->id,
        'discount' => $coupon->discount,
        'validity' =>$coupon->validity

       ];

       session()->put('coupon',$coupons);
        return redirect()->back()->with('success', 'Coupon Has Been Applied');
    }







    public function checkout()
    {
        $coupons=Coupon::all();
        return view('frontend.checkout',['coupons'=>$coupons]);
    }
}
