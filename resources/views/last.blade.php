@include('frontend.header')
<div class="last-container">
    <div id="alert">
        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
    </div>
    <div class="last-inner">
        <img src="{{asset('images/thank_you.jpg')}}" alt="">
    </div>
    <div class="last-inner1">
        <a href="{{route('index')}}" class="last-home">Home Page</a>
        <a href="{{route('user.order')}}" class="last-order">Order Page</a>
    </div>
</div>
@include('frontend.footer')
