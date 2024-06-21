<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}" rel="stylesheet">
<script src="https://kit.fontawesome.com/86a464678e.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('js/custom.js') }}"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <div class='admin-menu'>
                <img src="{{ URL::asset('/images/images.png') }}" height="50px" width="50px" alt="">
                <h3 class="logo-text">Shopping Mart</h3>
            </div>
            <div class="log">
                <a href="{{ route('logout') }}" class="nav-item nav-link">Logout</a>
            </div>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menu</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="{{route('admin.home')}}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Products
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                      <li><a class="dropdown-item" href="{{ route('admin.index') }}">Product Details</a></li>
                      <li><a class="dropdown-item" href="{{ route('admin.create') }}">Add Products</a></li>
                      <li><a class="dropdown-item" href="{{ route('admin.form.product') }}">Edit Orders</a></li>
                    </ul>
                  </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    User
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="{{route('admin.user')}}">User Table</a></li>
                  </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('admin.order')}}">Orders</a>
                  </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('admin.suscriber')}}">Suscribers</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('admin.enquiry')}}">Enquiries</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Coupon Codes
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                      <li><a class="dropdown-item" href="{{route('admin.showcoupons')}}">Coupon Details</a></li>
                      <li><a class="dropdown-item" href="{{route('admin.addcoupons')}}">Add Coupons</a></li>
                    </ul>
                  </li>
                  <li>
                    <a class="nav-link active" aria-current="page" href="{{route('admin.about')}}">About Us</a>
                  </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>

