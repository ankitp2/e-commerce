<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\select;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Coupon::all();
        return view('admin.showcoupons',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=new Coupon;
        $data->coupon_code=$request->coupon_code;
        $data->discount=$request->discount;
        $data->discount_type=$request->discount_type;
        $data->description=$request->description;
        $data->save();
        return redirect()->back()->with('success','Coupon Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        return view('admin.addcoupons');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon,$id)
    {
        $data=Coupon::find($id);
        return view('admin.updatecoupons',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon,$id)
    {
        $data=Coupon::find($id);
        $data->coupon_code=$request->coupon_code;
        $data->discount=$request->discount;
        $data->discount_type=$request->discount_type;
        $data->description=$request->description;
        $data->save();
        return redirect()->route('admin.showcoupons')->with('success','Coupon Updated Succesfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon ,$id)
    {
        $data=Coupon::find($id)->delete();
        return redirect()->back()->with('danger','Coupon Deleted Successfully.');
    }
    public function cart(Coupon $coupon)
    {
        try{
        $couponcode=$_REQUEST['coupon'];
        $data=Coupon::select('coupon_code','discount_type','discount')->where('coupon_code',$couponcode)->first()->toArray();
        $used=Order::where('user_id',Auth::user()->id)->where('coupon_code',$couponcode)->count();
        if($used > 0){
            $data['coupon_code']=$couponcode;
            $data['discount']=0;
            $data['discount_type']="rupees";
            return Response()->json(['message' => 'Coupon already Used', 'data' => $data]);
        }else{
            return Response()->json(['message' => 'Coupon used Successfully', 'data' => $data]);
        }
    }catch(Exception $e){
        return $e;
    }
    }
    public function description(Request $request){
        $value=$_REQUEST['value'];
        $data=Coupon::select('description')->where('coupon_code',$value)->first()->toArray();
        if($data){
            return Response()->json($data);
        }

    }
}


