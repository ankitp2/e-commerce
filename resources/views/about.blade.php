@include('frontend.header')
<div class="aboutcontainer">
    <div class="card bg-dark text-white">
        <img src="{{asset('images/about.jpg')}}" class="card-img1" alt="...">
        <div class="card-img-overlay">
          <h5 class="card-title1">About Us</h5>
        </div>
      </div>
      <div class="about1">
        <p>&nbsp;&nbsp;&nbsp;&nbsp;{{$data}}</p>
      </div>
</div>
@include('frontend.footer')
