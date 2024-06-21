<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $address=new Address();
        $address->name=$request->name;
        $address->mob=$request->mob;
        $address->pin=$request->pin;
        $address->state=$request->state;
        $address->area=$request->area;
        $address->city=$request->city;
        $address->hno=$request->hno;
        $address->lmark=$request->lmark;
        $address->user_id=Auth::user()->id;
        $address->save();
        $user_id=Auth::user()->id;
        $totalprice=$request->ttlprice;
        $c_code=$request->c_code;
        $discount=$request->discount;
        $discount_type=$request->discount_type;
        $address=Address::where("user_id",$user_id)->get();
        $cart =Cart::join('products', 'product_id', '=', 'products.id')->select('carts.*', 'name', 'image', 'category', 'price', 'description', 'quantity', 'product_id')->where('user_id', $user_id)->get();
        return view('checkout',compact('address','cart','totalprice','c_code','discount','discount_type'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address,$id)
    {
        $address=Address::find($id);
        $address->name=$request->name;
        $address->mob=$request->mob;
        $address->pin=$request->pin;
        $address->area=$request->area;
        $address->city=$request->city;
        $address->state=$request->state;
        $address->lmark=$request->lmark;
        $address->hno=$request->hno;
        $address->save();
        return redirect()->back()->with('success',"Your address updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address,$id)
    {
        $address=Address::find($id)->delete();
        return redirect()->back()->with('danger','Addresss deleted successfully.');
    }
}
