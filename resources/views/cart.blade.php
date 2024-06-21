@include('frontend.header')
<meta name="csrf-token" content="{{ csrf_token() }}">
     <div class="wrapper">
     @yield('content')
     </div>
<div class="cart-container">
    <div class="innerdiv">
        <table class="table" id="table1">
            <h4>Shopping Bag</h4>
            <tr>
                <th class="first-col">Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th></th>
            </tr>
            @php
                $totalprice = 0;
                $count = 0;
            @endphp
            @foreach ($data as $x)
                <tr>
                    <td>
                        <div class="cart-div">
                            <div class="cart-inner">
                                <img src="{{ asset('storage/' . $x->image) }}"
                                    style="width: 100px;height:100px;border-radius:20px;" alt="">
                            </div>
                            <div class="cart-inner1">
                                <p>{{ $x->category }}</p>
                                <h6>{{ $x->name }}</h6>
                                <p>{{ $x->description }}</p>
                            </div>
                        </div>
                    </td>
                    <td> ₹<span class="price{{ $x->id }}" id="price_base">{{ $x->price }}</span></td>
                    <td>
                        <button class="btn-minus{{ $x->id }}" id="minus" onclick="minus({{ $x->id }})"
                            style="border-radius: 50%;background-color: whitesmoke;"><i
                                class="fa-solid fa-minus"></i></button>&nbsp;
                        <b><input id="qty" class="qty{{ $x->id }}" type="number" readonly
                                value="{{ $x->quantity }}"></b>
                        <button class="btn-plus{{ $x->id }}" id="plus" onclick="plus({{ $x->id }})"
                            style="border-radius: 50%;background-color: rgb(245, 245, 245);"><i
                                class="fa-solid fa-plus"></i></button>
                    </td>
                    <td><b>₹</b><b class="itemtotal" id="itemtotal{{ $x->id }}">
                            {{ $x->price * $x->quantity }}</b></td>
                    <td>
                        <a href="{{ route('cart.delete', $x->product_id) }}" class="cart-btn1"
                            style="background-color:red;"><i class="fa-solid fa-xmark"></i></a>
                    </td>
                </tr>
                @php
                    $totalprice += $x->price * $x->quantity;
                    $count++;
                @endphp
            @endforeach
        </table>
        <div class="total">
            <div class="total-div1">
                <b>Grand Total</b>
            </div>
            <div><b>₹</b><b class="totalprice">{{ $totalprice }}</b></div>
        </div>
    </div>
    {{-- side items --}}
    <div class="side-div">
        <div class="inner-sidediv1">
            <b style="font-family: 'Pacifico', cursive;font-weight:bolder;font-size:20px;">Coupon Code</b>
            <p style="font-family:'Lobster';">Enter your coupon code below for extra offer benfits.</p>
                <input id="coupon" type="text" name="coupon" placeholder="Enter Your Coupon Code">
                <div id="free_div">
                <p id="coupon_desc"></p></div>
                <button onclick="coupon()" class="btn btn-dark" style=" border-radius: 20px;width: 240px; margin-left: 20px;height: 40px;text-align: center;">Apply</button>
        </div>
        <hr>
        <div class="inner-sidediv2">
            <b style="font-family: 'Pacifico', cursive;font-weight:bolder;font-size:20px;">Cart Total</b>
            <div><span>Cart Subtotal</span><span style="margin-left: 100px;"><b>₹</b><b
                        class="ttlprice">{{ $totalprice }}</b></span></div>
            <div><span>Delivery Charges</span><span style="margin-left: 95px;">Free</span></div>
            <div><span>Discount</span><span style="margin-left: 140px;">₹<span id="discount">0</span></span></div>
            <div><span><b>Cart Total</b></span><span style="margin-left: 120px;"><b>₹</b><b
                        id="crt">{{ $totalprice }}</b></span></div>
            <div>
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <input type="text" hidden name="grandtotal" id="gt" value="{{ $totalprice }}">
                    <input type="hidden" hidden name="coupon_code" id="c_code" value="">
                    <input type="hidden" id="pro-discount" name="prod_discount" value="">
                    <input type="hidden" id="pro-discount_type" name="prod_discount_type" value="">
                    <input type="submit" id="chkout" class="btn btn-light" value="Proceed To Checkout">
                </form>
            </div>
        </div>
    </div>
</div>
@include('frontend.footer')
