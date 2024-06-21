@include('admin.adminheader')
<div class="adminorder-container">
    <div class="ad-second"><b>Orders</b></div>
    <div class="adorder-first">
        <form action="" method="POST">
            @csrf
            <input type="text" id="search" class="search-input" name="search" placeholder="🔍 Search OrderID">
            <input type="submit" class="btn btn-dark">
        </form>
    </div>
    <table class="table">
        <tr>
            <th>OrderID</th>
            <th>UserID</th>
            <th>ItemName</th>
            <th>Quantity</th>
            <th>Amount</th>
            <th>CouponCode</th>
            <th>PaymentMode</th>
            <th>OrderStatus</th>
            <th>OrderTime</th>
            <th>Info</th>
        </tr>
        <tbody>
        @foreach ($order as $x)
        <tr>
            <td>#{{$x->order_id}}</td>
            <td>{{$x->user_id}}</td>
            <td>{{$x->item_name}}</td>
            <td>{{$x->quantity}}</td>
            <td>{{$x->amount}}</td>
            <td>{{$x->coupon_code}}</td>
            <td>{{$x->payment}}</td>
            <td><span id="sts" class="sts{{$x->id}}">{{$x->status}}</span></td>
            <td>{{$x->created_at}}</td>
            <td><a href="{{route('admin.edit',$x->id)}}" class="btn btn-dark">Update Details</a></td>
        </tr>
        <script>
            try{
            color({{$x->id}});
            }catch(err){
                alert(err.message);
            }
        </script>
        @endforeach
       </tbody>
    </table>
    <span class="page">
        {{ $order->onEachSide(3)->links() }}
    </span>
</div>
@include('admin.adminfooter')
