@include('frontend.header')
<div class="container">
    <div class="div1">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="{{ route('laptop') }}"><img class="carousel" src="{{ URL::asset('/images/laptop0.jpg') }}"
                            class="d-block w-100" alt="..."></a>
                    <div class="carousel-caption d-none d-md-block">
                        <h5 style="background-color:red;width:110px;">Laptops</h5>
                        <p style="background-color:black;color:white;width:260px;">Explore our Laptop phone
                            collections...</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <a href="{{ route('camera') }}"><img class="carousel" src="{{ URL::asset('/images/camera0.avif') }}"
                            class="d-block w-100" alt="..."></a>
                    <div class="carousel-caption d-none d-md-block">
                        <h5 style="background-color:red;width:110px;">Camera</h5>
                        <p style="background-color:black;color:white;width:260px;">Explore our camera collections...</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <a href="{{ route('mobile') }}"><img class="carousel" src="{{ URL::asset('/images/mobile0.jpg') }}"
                            class="d-block w-100" alt="..."></a>
                    <div class="carousel-caption d-none d-md-block">
                        <h5 style="background-color:red;width:150px;">Mobile Phones</h5>
                        <p style="background-color:black;color:white;width:280px;">Explore our Mobile collections...</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="container2">
            <a href="{{ route('mobile') }}">
                <div class="card text-bg-dark" style="border: 2px solid black;">
                    <img class="click" src="{{ URL::asset('/images/mob.jpg') }}" class="card-img" alt="...">
                    <div class="card-img-overlay">
                        <h5 class="card-title" style="width: 130px;">Mobile Phones</h5>
                    </div>
                </div>
            </a>
            <a href="{{ route('camera') }}">
                <div class="card text-bg-dark">
                    <img class="click" src="{{ URL::asset('/images/cam1.avif') }}" class="card-img" alt="...">
                    <div class="card-img-overlay">
                        <h5 class="card-title" style="width: 70px;">Camera</h5>
                    </div>
                </div>
            </a>
            <a href="{{ route('laptop') }}">
                <div class="card text-bg-dark">
                    <img class="click" src="{{ URL::asset('/images/laptop.jpg') }}" class="card-img" alt="...">
                    <div class="card-img-overlay">
                        <h5 class="card-title" style="width: 70px;">Laptops</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
    {{-- div3 start --}}
    <div class="container3">
        <div class="section-title">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;margin-top:80px;">Our Services</h4>
        </div>
        <div class="container4">
            <div class="innercont">
                <div>
                    <img src="{{ asset('images/delivery.avif') }}" style="width:200px;heigth:180px;" alt="">
                </div>
                <div style="margin-top:10px;">
                    <h4><i class="fa fa-truck service-icon"></i> Free Home Delivery</h4>
                    <p class="m-0">Get your order in your doorstep with no extra cost.Order and enjoy
                        your free delivery.</p>
                </div>
            </div>
            <div class="innercont">
                <div>
                    <img src="{{ asset('images/customer-support.avif') }}" style="width:200px;heigth:180px;" alt="">
                </div>
                <div style="margin-top:10px;">
                    <h4><i class="bi bi-telephone"></i> 24/7 Customer Support</h4>
                    <p class="m-0">We provide 24/7 customer support. For any query you can contact us
                        anytime.</p>
                </div>
            </div>
            <div class="innercont">
                <div>
                    <img src="{{ asset('images/warrenty.avif') }}" style="width:200px;heigth:160px;" alt="">
                </div>
                <div style="margin-top:10px;">
                    <h4><i class="fa fa-award service-icon"></i> One Year Store Warranty</h4>
                    <p class="m-0">We provide extra <b>1 year</b> store warranty to our customer.</p>
                </div>
            </div>
            <div class="innercont">
                <div>
                    <img src="{{ asset('images/gift.jpg') }}" style="width:200px;heigth:180px;" alt="">
                </div>
                <div style="margin-top:10px;">
                        <h4><i class="bi bi-gift-fill"></i> Assured Gifts</h4>
                    <p class="m-0">Assured gifts on every order.</p>
                </div>
            </div>
        </div>
        {{-- <div class="container-fluid pt-5">
            <div class="container4">
                <div class="section-title">
                    <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Our Services</h4>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-5">
                        <div class="row align-items-center">
                            <div class="col-sm-5">
                                <img class="img-fluid mb-3 mb-sm-0"
                                    src="{{ URL::asset('/images/pexels-norma-mortenson-4393426.jpg') }}"
                                    alt="">
                            </div>
                            <div class="col-sm-7" style="background-color:beige;">
                                <h4><i class="fa fa-truck service-icon"></i> Free Home Delivery</h4>
                                <p class="m-0">Get your order in your doorstep with no extra cost.Order and enjoy
                                    your free delivery.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <div class="row align-items-center">
                            <div class="col-sm-5">
                                <img class="img-fluid mb-3 mb-sm-0" src="{{ URL::asset('/images/cs.jpg') }}"
                                    alt="">
                            </div>
                            <div class="col-sm-7">
                                <h4><i class="bi bi-telephone"></i> 24/7 Customer Support</h4>
                                <p class="m-0">We provide 24/7 customer support. For any query you can contact us
                                    anytime.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <div class="row align-items-center">
                            <div class="col-sm-5">
                                <img class="img-fluid mb-3 mb-sm-0" src="{{ URL::asset('/images/warrenty.webp') }}"
                                    alt="">
                            </div>
                            <div class="col-sm-7">
                                <h4><i class="fa fa-award service-icon"></i> One Year Store Warranty</h4>
                                <p class="m-0">We provide extra <b>1 year</b> store warranty to our customer.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <div class="row align-items-center">
                            <div class="col-sm-5">
                                <img class="img-fluid mb-3 mb-sm-0"
                                    src="{{ URL::asset('/images/pexels-nurseryart-360624.jpg') }}" alt="">
                            </div>
                            <div class="col-sm-7">
                                <h4><i class="bi bi-gift-fill"></i> Assured Gifts on every Purchase</h4>
                                <p class="m-0">Assured gifts on every order.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    {{-- div4 start --}}
    <div class="offer container-fluid my-5 py-5 text-center position-relative ">
        <div class="container py-5" id="sus">
            <div>
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
            </div>
            <h4 class="display-5 text-primary mt-3" style="margin-yop:10px;">Exiting Offers for our Suscribers</h4>
            <form class="form-inline justify-content-center mb-4" action="{{ route('user.suscribe') }}"
                method="POST">
                @csrf
                <div class="input-group">
                    <input type="email" name="email" class="form-control p-3" placeholder="Your Email"
                        style="height: 40px;">
                    <div class="input-group-append">
                        <input type="submit" value="Suscribe" class="btn btn-primary font-weight-bold px-4">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('frontend.footer')
