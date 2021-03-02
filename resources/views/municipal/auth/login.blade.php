
<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link rel="icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">


        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="ITUDevTeam">

        <title>Login | {{ config('app.name') }}</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{ asset('/dist/css/app.css') }}" />
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="login">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="" class="-intro-x flex items-center pt-5 focus:outline-none">
                        <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="/dist/images/logo.svg">
                        <span class="text-white text-lg ml-3"><span class="font-medium">SurSur-ATP</span> </span>
                    </a>
                    <div class="my-auto">
                        <img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="/dist/images/illustration.svg">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            A few more clicks to
                            <br>
                            sign in to your account.
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white"></div>
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Sign In
                        </h2>

                        <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
                        <form action="{{ route('municipal.auth.loginMunicipal') }}" method="POST">
                            @csrf
                            <div class="intro-x mt-8">
                                <div class="text-theme-6">
                                   {{ $errors->first('message') }}
                                </div>
                                <input type="text" class="intro-x login__input input input--lg border border-gray-300 block {{ $errors->has('message') ? 'border-theme-6' : '' }}" placeholder="Username" name="username">
                                <input type="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4 {{ $errors->has('message') ? 'border-theme-6' : '' }}" placeholder="Password" name="password">
                            </div>
                            <div class="intro-x flex text-gray-700 text-xs sm:text-sm mt-4">
                                <div class="flex items-center mr-auto">
                                    <input type="checkbox" class="input border mr-2" name="remember_me" id="remember-me">
                                    <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                                </div>
                            </div>
                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <button type="submit" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">Login</button>
                            </div>
                        </form>

                        <div class="intro-x mt-10 xl:mt-24 text-gray-700 text-center xl:text-left">
                            By signin up, you agree to our
                            <br>
                            <a class="text-theme-1" href="">Terms and Conditions</a> & <a class="text-theme-1" href="">Privacy Policy</a>
                        </div>
                    </div>
                </div>
                <!-- END: Login Form -->
            </div>
        </div>
        <!-- BEGIN: JS Assets-->
        <script src=" {{ asset('/dist/js/app.js') }}"></script>
        <!-- END: JS Assets-->
    </body>
</html>
{{-- <!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name') }} | Login</title>

    <!-- Favicons -->
    <link href="img/logo.png" rel="icon">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/style.css">
    <style>
        body {
            height : auto;
            width : 100%;
            background : url(http://surigaodelsur.ph/images/home/Surigao_del_Sur_Provincial_Capitol.jpg) center center no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="middle-box text-center bg-white  p-5 rounded shadow  mt-2">
    <img class="w-50 img-fluid" src="http://surigaodelsur.ph/images/logo.png" alt="">
    <hr>
       <h2 class="text-dark">Welcome to <b>Surigao del Sur</b> <br><b>SurSur - ATP<br>(Action Trace & Protect)</h2>
       <div>
        @if ($errors->any())
                <div class="text-danger">
                    <div class="p-3 font-weight-bold">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                    </div>
                </div>
            @endif
       </div>
        <form action="{{ route('admin.auth.loginAdmin') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group text-left">
                <label>Username</label>
                <input type="text" class="form-control" placeholder="Enter your Username" name="username" value="{{ old('username') }}">
            </div>
            <div class="form-group text-left">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Enter your Password" name="password">
            </div>
            <button type="submit" id="btn" class="btn btn-success block full-width m-b font-weight-bold">LOGIN</button>
        </form>
    </div>
</body>
</html>
 --}}

{{-- <!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicons -->
    <link rel="icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">
    <title>{{ config('app.name') }} | Login</title>


  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/style.css">
    <style>
        body {
            height : auto;
            width : 100%;
            background : url(http://surigaodelsur.ph/images/home/Surigao_del_Sur_Provincial_Capitol.jpg) center center no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="middle-box text-center bg-white p-5 rounded shadow  mt-2">
    <img class="w-50 img-fluid" src="http://surigaodelsur.ph/images/logo.png" alt="">
    <hr>
       <h2 class="text-dark">Welcome to <b>Surigao del Sur</b> <br><b>SurSur - ATP<br>(Action Trace & Protect)</h2>
       <div>
        @if ($errors->any())
                <div class="text-danger">
                    <div class="p-3 font-weight-bold">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                    </div>
                </div>
            @endif
       </div>
        <form action="{{ route('municipal.auth.loginMunicipal') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group text-left">
                <label>Username</label>
                <input type="text" class="form-control" placeholder="Enter your Username" name="username" value="{{ old('username') }}">
            </div>
            <div class="form-group text-left">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Enter your Password" name="password">
            </div>
            <button type="submit" id="btn" class="btn btn-success block full-width m-b font-weight-bold">LOGIN</button>
            <a href="{{ route('download-android-apk') }}">
                <img class="img-fluid"  src="{{ asset('storage/images/download.png') }}" alt="">
            </a>

        </form>
    </div>
</body>
</html>
 --}}
