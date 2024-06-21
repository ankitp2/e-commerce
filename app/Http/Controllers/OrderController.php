<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $order = DB::table('orders')->join('products', 'product_id', '=', 'products.id')->select('orders.*', 'image', 'price')->where('user_id', $user_id)->paginate(9);
        return view("orderpage", compact("order"));
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
            $user_id = Auth::user()->id;
            $cart =  DB::table('carts')->join('products', 'product_id', '=', 'products.id')->select('carts.*', 'name', 'price', 'quantity', 'product_id')->where('user_id', $user_id)->get()->toArray();
            $totalquantity = DB::table('carts')->join('products', 'product_id', '=', 'products.id')->select('quantity')->where('user_id', $user_id)->get();
            $count_num = 0;
            foreach ($totalquantity as $count) {
                $count_num += $count->quantity;
            }
            foreach ($cart as $value) {
                $order = new Order();
                $order->order_id = rand(100000, 999999);
                $order->user_id = $user_id;
                $order->address = $request->address;
                $order->coupon_code = $request->coupon_code;
                $order->product_id = $value->product_id;
                $order->quantity = $value->quantity;
                $order->item_name = $value->name;
                $order->status = "placed";
                $order->payment = $request->payment;
                $discount = $request->discount;
                $discount_type = $request->discount_type;
                if ($discount_type == 'percent') {
                    $amount = floor(($value->price * $discount) / 100);
                } else if ($discount_type == 'rupees') {
                    $amount = floor($discount / $count_num);
                }
                $order->amount = ($value->price - $amount) * $value->quantity;
                $order->save();
            }
            $emp_cart = DB::table('carts')->where('user_id', $user_id)->delete();
            return view('last');
    }
    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order = DB::table('orders')->orderBy('id', 'desc')->paginate(10);
        return view('admin.adminorder', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order, $id)
    {
        $info = Order::find($id);
        $product_id = $info->product_id;
        $product = Product::find($product_id);
        return view('admin.adminproductinfo', compact('info', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order, $id)
    {
        $order = Order::find($id);
        $order->address = $request->address;
        $order->status = $request->status;
        $order->save();
        return redirect()->back()->with('success', 'Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function cancel($id)
    {
        $order = Order::find($id);
        $order->status = 'cancelled';
        $order->save();
        return redirect()->back()->with('danger', 'Your Product Cancelled Successfully.');
    }
    public function home()
    {
        $from = Carbon::now()->startOfMonth()->toDateString();
        $to = Carbon::now()->endOfMonth()->toDateString();
        $total_order = Order::whereBetween('created_at', [$from, $to])->count();
        $placed = Order::where('status', 'placed')->count();
        $shipped = Order::where('status', 'shipped')->count();
        $confirmed = Order::where('status', 'confirmed')->count();
        $out_for_delivery = Order::where('status', 'out for delivery')->count();
        $start_date = Carbon::now()->startOfDay()->toDateString();
        $end_date = Carbon::now()->endOfDay()->toDateString();
        $delivered_today = Order::where('status', 'delivered')->whereBetween('updated_at', [$start_date, $end_date])->count();
        $cancelled_today = Order::where('status', 'cancelled')->whereBetween('updated_at', [$start_date, $end_date])->count();
        return view('admin.adminhome', compact('total_order', 'shipped', 'placed', 'confirmed', 'out_for_delivery', 'delivered_today', 'cancelled_today'));
    }
    public function current_month()
    {
        $from = Carbon::now()->startOfMonth()->toDateString();
        $to = Carbon::now()->endOfMonth()->toDateString();
        $item = Order::whereBetween('created_at', [$from, $to])->orderBy('id', 'desc')->get();
        $title = "Order In This Month";
        return view('admin.adminhomeview', compact('item', 'title'));
    }
    public function placed()
    {
        $item = Order::where('status', 'placed')->get();
        $title = "Order Placed";
        return view('admin.adminhomeview', compact('item', 'title'));
    }
    public function confirmed()
    {
        $item = Order::where('status', 'confirmed')->get();
        $title = "Order Confirmed";
        return view('admin.adminhomeview', compact('item', 'title'));
    }
    public function shipped()
    {
        $item = Order::where('status', 'shipped')->get();
        $title = "Order Shipped";
        return view('admin.adminhomeview', compact('item', 'title'));
    }
    public function ofd()
    {
        $item = Order::where('status', 'out for delivery')->get();
        $title = "Order Out For Delivery";
        return view('admin.adminhomeview', compact('item', 'title'));
    }
    public function del_today()
    {
        $start_date = Carbon::now()->startOfDay()->toDateString();
        $end_date = Carbon::now()->endOfDay()->toDateString();
        $item = Order::where('status', 'delivered')->whereBetween('updated_at', [$start_date, $end_date])->get();
        $title = "Order Delivered Today";
        return view('admin.adminhomeview', compact('item', 'title'));
    }
    public function cnc_today()
    {
        $start_date = Carbon::now()->startOfDay()->toDateString();
        $end_date = Carbon::now()->endOfDay()->toDateString();
        $item = Order::where('status', 'cancelled')->whereBetween('updated_at', [$start_date, $end_date])->get();
        $title = "Order Cancelled Today";
        return view('admin.adminhomeview', compact('item', 'title'));
    }
    public function enquiry()
    {
        return view('admin.enquiry');
    }
    public function enquiry_result(Request $request)
    {
        $from_date = $request->from;
        $to_date = $request->to;
        $status = $request->status;
        $item = Order::where('status', $status)->whereBetween('updated_at', [$from_date, $to_date])->get();
        $title = "Order " . $status . " between " . $from_date . " to " . $to_date;
        return view('admin.adminhomeview', compact('item', 'title'));
    }
}
