@include('admin.adminheader')
<div class="showcoupon">
    <div id="alert" style="margin-top: 70px;max-height:30px;">
        @if (session()->has('danger'))
        <div class="alert alert-danger">
            {{ session()->get('danger') }}
        </div>
        @endif
        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
    </div>
    <h3>Coupons</h3>
    <table class="table">
        <tr>
            <th>CouponCode</th>
            <th>Discount</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        @foreach ($data as $coupons)
        <tr>
            <td style="font-family: fantasy;">{{$coupons->coupon_code}}</td>
            <td>{{$coupons->discount}}<span> {{$coupons->discount_type}}</span></td>
            <td>{{$coupons->description}}</td>
            <td>
                <a href="{{route('admin.coupon.delete',$coupons->id)}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>&nbsp;&nbsp;
                <a href="{{route('admin.coupon.edit',$coupons->id)}}" class="btn btn-warning"><i class="fa-solid fa-file-pen"></i></a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@include('admin.adminfooter')
