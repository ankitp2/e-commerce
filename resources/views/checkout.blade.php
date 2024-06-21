@include('frontend.header')
{{-- @dd($totalprice) --}}
<div class="chkout">
    <h2>CheckOut Information</h2>
    <div class="chkout-container">
        <div class="chkout-info">
            @foreach ($cart as $x)
                <div class="chkout-item">
                    <div class="chkout-itemimg">
                        <img src="{{ asset('storage/' . $x->image) }}" alt=""
                            style="width: 80px;height:80px;border-radius:15px;">
                    </div>
                    <div class="chkout-itemdetails">
                        <h6>{{ $x->name }}</h6>
                        <p>{{ $x->quantity }} Items</p>
                    </div>
                </div>
            @endforeach
            <hr>
            <span style="display:inline;"><b style="margin-right:180px;">Subtotal:</b><b
                    class="amnt">₹{{ $totalprice }}</b></span>
        </div>
        {{-- side div --}}
        <div class="chkoutpayment">
            <h3>Address Information</h3>
            <div class="onee">
                <div class="address">
                    <form action="{{route('user.placeorder')}}" method="POST">
                        @csrf
                        <select name="address" id="adr" class="select-addr">
                            <option value="" disabled selected>Select Address</option>
                            @foreach ($address as $y)
                                <option
                                    value="{{ $y->name }},{{ $y->mob }},{{ $y->hno }},{{ $y->area }},{{ $y->city }},{{ $y->state }},{{ $y->pin }},{{ $y->lmark }}">
                                    {{ $y->name }},{{ $y->mob }},{{ $y->hno }},{{ $y->area }},{{ $y->city }},{{ $y->state }},{{ $y->pin }},{{ $y->lmark }}
                                </option>
                            @endforeach
                            </select>
                    </form>
                </div>
                <button type="button" id="addAddress" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-solid fa-plus" style="color: #84b3f0;"></i>Add Address
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" style="margin-right: 320px;">Add Address
                                </h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                                    style="border:transparent;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('new.address') }}" method="POST">
                                    @csrf
                                    <div class="addr-form">
                                        <div class="addrform1">
                                            <input type="text" name="name" placeholder="Name">
                                        </div>
                                        <div class="addrform5">
                                            <input type="number" name="mob" placeholder="Mobile No">
                                        </div>
                                        <div class="addrform2">
                                            <input type="text" name="hno" placeholder="House No.">
                                            <input type="text" name="area" placeholder="Area">
                                        </div>
                                        <div class="addrform3">
                                            <input type="text" name="city" placeholder="City">
                                            <input type="number" name="pin" placeholder="Pin Code">
                                        </div>
                                        <div class="addrform4">
                                            <input type="text" name="state" placeholder="State">
                                            <input type="text" name="lmark" placeholder="Landmark">
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="ttlprice" value={{$totalprice}}>
                                <input type="hidden" name="c_code" value={{$c_code}}>
                                <input type="hidden" name="discount" value={{$discount}}>
                                <input type="hidden" name="discount_type" value={{$discount_type}}>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" value="Save">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="twoo">
                <h3>Payment Mode</h3>
                <form action="{{route('user.placeorder')}}" method="POST">
                    @csrf
                <input type="hidden" id="add-adr" name="address" value=" ">
                <input type="hidden" id="cpn_code" name="coupon_code" value="{{$c_code}}">
                <input type="hidden" id="add-grandtotal" name="grandtotal" value="{{$totalprice}}">
                <input type="hidden" id="add-discount" name="discount" value="{{$discount}}">
                <input type="hidden" id="add-discount_type" name="discount_type" value="{{$discount_type}}">
                <input type="radio" name="payment" value="Online Payment"> <b>Online Payment</b><br>
                <input type="radio" name="payment" value="COD"> <b>Cash On Delivery</b><br><br>
                <input type="submit" id="sbbt" value="Place Order" class="btn btn-primary">
            </form>
            </div>
        </div>
    </div>
</div>
@include('frontend.footer')
