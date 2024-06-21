@include('admin.adminheader')
<div id="alert" style="margin-top: 70px;max-height:30px;">
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
</div>
<div class="prodinfo-container1">
    <div class="prodinfo-container">
        <div class="prodinfo1">
            <div><img src="{{ asset('storage/' . $product->image) }}" alt=""></div>
            <div class="prodinfo1-2">
                <h6>{{ $info->item_name }}</h6>
                <p>Quantity: {{ $info->quantity }}</p>
                <p>ItemType: {{ $product->category }}</p>
            </div>
        </div>
        <div class="prodinfo2-1"><b>Total Amount To Be Paid:</b>
            <b>₹{{ $info->amount }}</b>
        </div>
    </div>
    <div class="prodinfo3">
        <div class="prodinfo2">
            <span><i class="fa-solid  fa-location-dot"></i> <input id="addr-value" type="text"
                    value="{{ $info->address }}" disabled="true" ></span><button id="rr"><i
                    class="fa-regular fa-pen-to-square" style="color: #74C0FC;"></i></button>
        </div>
        <div class="prodinfo2-3">
            <b>Payment Mode: {{$info->payment}}</b><br><br>
            <b>Order Time: {{$info->created_at}}</b>
        </div>
        <div class="prodinfo2-4">
            <select name="status" class="status" disabled="true">
            <option value="placed" {{ $info->status == 'placed' ? 'selected' : '' }}>placed</option>
            <option value="confirmed" {{ $info->status == 'confirmed' ? 'selected' : '' }}>confirmed</option>
            <option value="shipped" {{ $info->status == 'shipped' ? 'selected' : '' }}>shipped</option>
            <option value="out for delivery" {{ $info->status == 'out for delivery' ? 'selected' : '' }}>out for delivery</option>
            <option value="delivered" {{ $info->status == 'delivered' ? 'selected' : '' }}>delivered</option>
            <option value="cancelled" {{ $info->status == 'cancelled' ? 'selected' : '' }}>cancelled</option>
        </select>&nbsp;&nbsp;
        <button id="stts"><i
            class="fa-regular fa-pen-to-square" style="color: #74C0FC;"></i></button>
        </div>
    </div>

    <form action="{{route('admin.order.update',$info->id)}}" method="POST">
        @csrf
        <input type="hidden" name="address" id="ads" value=" ">
        <input type="hidden" name="status" id="ssts" value=" ">
        <input type="submit" class="btn btn-dark" value="Update" id="sbbbt">
    </form>
</div>
@include('admin.adminfooter')
