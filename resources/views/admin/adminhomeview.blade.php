@include('admin.adminheader')
<div class="adminhome-view">
    <table class="table">
        <center><h3 class="h3">{{$title}}</h3></center>
        <tr>
            <th>OrderID</th>
            <th>UserID</th>
            <th>ItemName</th>
            <th>Quantity</th>
            <th>PaymentMode</th>
            <th>Amount</th>
            <th>Address</th>
        </tr>
        @foreach ($item as $x)
        <tr>
            <td>#{{$x->order_id}}</td>
            <td>{{$x->user_id}}</td>
            <td>{{$x->item_name}}</td>
            <td>{{$x->quantity}}</td>
            <td>{{$x->payment}}</td>
            <td>{{$x->amount}}</td>
            <td>{{$x->address}}</td>
        </tr>
        @endforeach
    </table>
</div>
@include('admin.adminfooter')
