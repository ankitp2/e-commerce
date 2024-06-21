@include('frontend.header')
<div id="alert">
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
</div>
<div class="card-container">
    @foreach ($data as $x)
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{ asset('storage/' . $x->image) }}" style="max-width:285px;max-height:285px;" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{ $x->name }}</h5>
                <b>Price:</b><span>{{ $x->price }}</span>
                <p class="card-text1">{{ $x->description }}</p>
                <div class="bttn">
                    <span>
                        <form action="{{route('addtocart')}}" method="POST">
                            @csrf
                            <input type="number" hidden name="product_id" value="{{ $x->id }}">
                            <input type="number" hidden name="quantity" value="1">
                            @guest
                            @else
                            <input type="number" hidden name="user_id" value="{{ Auth::user()->id }}">
                            @endguest
                            <input type="submit" id="addToCart" class="btn btn-primary" value="Add to Cart">
                        </form>
                    </span>
                    <span style="margin-left: 50px;"><a class="btn btn-info" href="#">View Item</a></span>
                </div>
            </div>
        </div>
    @endforeach
</div>
@include('frontend.footer')
