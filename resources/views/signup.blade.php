@include('frontend.header')
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    function onSubmit(token) {
        document.getElementById("loginForm").submit();
    }
</script>
<center>
    <div class="registration">
        <div id="alert">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
        <div class="signup">
            <div class="inner-main">
                <img style="width:350px;height:400px;border-radius:20px;" src="{{ asset('images/register.avif') }}"
                    alt="">
            </div>
            <div class="">
                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <u>
                        <h1 style="font-family: fantasy;">Register</h1>
                    </u>
                    <input class="input" type="text" name="name" placeholder="Enter Your Name"><br>
                    <div style="margin: 0;" class="mb-3">
                        <label for="formFileSm" style="font-family: fantasy" class="form-label">Profile Pic</label>
                        <input name="profile_pic" class="form-control form-control-sm" id="formFileSm" type="file"
                            style="width:300px;">
                    </div>
                    <input class="input" type="email" name="email" placeholder="Enter Your Email">
                    <input class="input" type="password" name="password" placeholder="Enter Your Password"><br>
                    <input type="submit" value="Register" class="btn btn-primary" class="register"
                        style="width:300px;">
                </form>
                <span>Already have an account?</span> <u id="login">Login</u>
            </div>
        </div>
        <div class="login">
            <div class="inner-main">
                <img style="width:350px;height:350px;border-radius:20px;" src="{{ asset('images/login.avif') }}"
                    alt="">
            </div>
            <div>
                <form action="{{ route('login') }}" method="POST" id="loginForm">
                    @csrf
                    <u>
                        <h1 style="font-family: fantasy;">Login</h1>
                    </u>
                    <input class="input" type="email" name="email" placeholder="Enter Your Email"><br>
                    <input class="input" type="password" name="password" placeholder="Enter Your Password"><br>
                    @if (config('services.recaptcha.key'))
                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
                    @endif
                    <input type="submit" value="Login" class="btn btn-primary" class="register" style="width:300px;">
                </form>
                <span>Don't have an account?</span> <u id="register">Register</u>
            </div>
        </div>
    </div>
</center>
@include('frontend.footer')
