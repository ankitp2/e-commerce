@include('admin.adminheader')
<div class="addcouponcontainer">
    <div id="alert">
        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
    </div>
    <h3>Add Coupons</h3>
    <div class="firstcoupcontainer">
        <div class="firstcoupcontainer1">
            <img style="width:320px;height:360px;" src="{{asset('images/coupon.jpg')}}" alt="">
        </div>
        <div class="firstcoupcontainer2">
            <form action="{{route('admin.coupon.update',$data->id)}}" method="POST">
                @csrf
                <input type="text" name="coupon_code" value="{{$data->coupon_code}}">
                {{-- <input type="text" name="description" placeholder="Description" id="coupondesc"> --}}
                <select class="form-floating mb-3" name="discount_type" id="">
                    <option disabled selected>Discount Type</option>
                    <option value="rupees" {{ $data->discount_type == 'rupees' ? 'selected' : '' }}>Rupees</option>
                    <option value="percent" {{ $data->discount_type == 'percent' ? 'selected' : '' }}>Percent</option>
                </select>
                <input type="number" name="discount" value="{{$data->discount}}">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingTextarea" style="height: 80px;width:300px;margin:20px" name="description" value="{{$data->description}}">
                    <label for="floatingTextarea" style="margin-left:20px;">Description</label>
                  </div>
                <input type="submit" value="Update Coupon" class="btn btn-dark">
            </form>
        </div>
    </div>
</div>
@include('admin.adminfooter')
