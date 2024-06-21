@include('frontend.header')
<div class="order-container">
    <div id="alert">
        @if (session()->has('danger'))
        <div class="alert alert-danger">
            {{ session()->get('danger') }}
        </div>
        @endif
    </div>
    <div class="order-main">
        @foreach ($order as $x)
            <div class="order-first">
                <div class="order1">
                    <div class="order1-1">
                        <span>OrderID</span>
                        <h5>#{{ $x->order_id }}</h5>
                    </div>
                    <div style="min-width:180px;">

                    </div>
                    <div class="order1-2">
                        <p class="sts{{ $x->id }}">{{ $x->status }}</p>
                    </div>
                </div>
                {{-- div1-end --}}
                <div class="order2">
                    <div class="order2-1">
                        <img style="width: 80px;height:80px;" src="{{ asset('storage/' . $x->image) }}" alt="">
                    </div>
                    <div class="order2-2">
                        <h6>{{ $x->item_name }}</h6>
                        <b>Rs.{{ $x->price }}</b><span>✗{{ $x->quantity }}</span>
                    </div>
                </div>
                {{-- div2 end --}}
                <div class="order3" id="order3{{$x->id}}">
                    <div class="order3-1">
                        <b>{{ $x->amount}}</b><span>({{ $x->quantity }} items)</span>
                    </div>
                    <div class="order3-3">
                        <a href="{{ route('user.order.cancel', $x->id) }}"  id="cnc{{$x->id}}" class="btn btn-danger"
                           >Cancel</a>
                    </div>
                    <div class="order3-2">
                        <a href="" class="btn btn-dark">Details</a>
                    </div>
                </div>
            </div>
            <script>
                color({{ $x->id }});
                cnc({{ $x->id }});
            </script>
        @endforeach
        <span class="page">
            {{ $order->onEachSide(9)->links() }}
        </span>
    </div>
</div>
@include('frontend.footer')
