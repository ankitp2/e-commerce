<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Mart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/86a464678e.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="{{ asset('js/custom.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+15+Charted&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</head>

<body>
    <div class="nav">
        <nav class="navbar">
            <div class="nav1">
                <img src="{{ URL::asset('/images/images.png') }}" height="50px" width="50px" alt="">
                <h3 class="logo-text" style="color: rgb(172, 4, 250);">Shopping Mart</h3>
            </div>
            <div class="nav2">
                <a href="{{ route('index') }}" class="nav-item nav-link">Home</a>
                <a href="{{route('user.about')}}" class="nav-item nav-link">About</a>
                <a href="{{ route('user.order') }}" class="nav-item nav-link">Order</a>
                <a href="#" class="nav-item nav-link">Contact</a>
                <a href="{{ route('cart') }}" class="nav-item nav-link"><i class="bi bi-cart4">
                        <strong>
                            @php
                                use Illuminate\Support\Facades\DB;
                                use Illuminate\Support\Facades\Auth;
                                if (isset(Auth::user()->id)) {
                                    $user_id = Auth::user()->id;
                                    $items = DB::table('carts')->where('user_id', $user_id)->count();
                                    echo $items;
                                } else {
                                    echo '0';
                                }
                            @endphp
                        </strong></i></a>
                @guest
                    <a href="{{ route('signup') }}" class="nav-item nav-link">Login/Register</a>
                @else
                    <div class="dropdown">
                        <button class="nav-item nav-link dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @php
                            $data=DB::table('users')->find($user_id);
                            @endphp
                            <img class="imgg" src="{{asset('storage/'.$data->profile_pic)}}" alt="">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href="{{ route('user.profile') }}" class="nav-item nav-link">Profile</a>
                            <a href="{{ route('logout') }}" class="nav-item nav-link">Logout</a>
                        </div>
                    </div>
                @endguest

            </div>
        </nav>
    </div>
