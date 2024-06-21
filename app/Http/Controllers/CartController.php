<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $data = DB::table('carts')->join('products', 'product_id', '=', 'products.id')->select('carts.*', 'name', 'image', 'category', 'price', 'description', 'quantity', 'product_id')->where('user_id', $user_id)->get();
        return view("cart", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (isset(Auth::user()->id)) {
            $user_id = Auth::user()->id;
            $product_id = $request->product_id;
            $existingproduct = Cart::where("user_id", $user_id)->where("product_id", $product_id)->first();
            if ($existingproduct) {
                return redirect()->back()->with("success", "Item already Exists in Cart.");
            }
            $data = new Cart();
            $data->product_id = $product_id;
            $data->user_id = $user_id;
            $data->quantity = $request->quantity;
            $data->save();
            return redirect()->back()->with("success", "Added To Cart Successfully.");
        } else {
            return redirect()->back()->with("success", "Login First");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     *@param  \Illuminate\Http\Request  $request
     *@return \Illuminate\Http\Response
     *@param \App\Models\Cart $cart
     */

    public function update(Request $request, Cart $cart)
    {
        if ($request->ajax()) {
            $value = $_REQUEST['value'];
            $cart_id = $_REQUEST['id'];
            $cart = Cart::find($cart_id);
            $cart->quantity = $value;
            $cart->save();
        }
        return Response()->json(['message' => 'Data upadated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        $user_id = Auth::user()->id;
        $product_id = $request->id;
        $data = Cart::where("user_id", $user_id)->where("product_id", $product_id);
        $data->delete();
        return redirect()->back()->with("success", "Product deleted from cart successfully.");
    }
    public function checkout(Request $request)
    {

        $totalprice = $request->grandtotal;
        $discount=$request->prod_discount;
        $discount_type=$request->prod_discount_type;
        $c_code= $request->coupon_code;
        $user_id=Auth::user()->id;
        $address=Address::where("user_id",$user_id)->get();
        $cart = DB::table('carts')->join('products', 'product_id', '=', 'products.id')->select('carts.*', 'name', 'image', 'category', 'price', 'description', 'quantity', 'product_id')->where('user_id', $user_id)->get();
        return view('checkout', compact('address','cart','totalprice','discount','c_code','discount_type'));
    }
}
