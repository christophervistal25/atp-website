
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
                        <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="/dist/images/logo.png">
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
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="intro-x mt-8">
                                <div class="text-theme-6">
                                    @if($errors->count() >= 1)
                                        Please check your username / password.
                                    @endif

                                </div>
                                <input type="text" class="intro-x login__input input input--lg border border-gray-300 block {{ $errors->count() >= 1 ? 'border-theme-6' : '' }}" placeholder="Username" name="username" value="{{ old('username') }}">
                                <input type="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4 {{ $errors->count() ? 'border-theme-6' : '' }}" placeholder="Password" name="password">
                            </div>
                            <div class="intro-x flex text-gray-700 text-xs sm:text-sm mt-4">
                                <div class="flex items-center mr-auto">
                                    <input type="checkbox" class="input border mr-2" name="remember_me" id="remember-me">
                                    <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                                </div>
                            </div>
                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <button type="submit" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">Login</button>
                                <button id="register" type="button" class="button button--lg w-full xl:w-32 text-gray-700 border border-gray-300 mt-3 xl:mt-0">Sign up</button>
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
        <script>
            $('#register').click((e) => window.location.href = "{{ route('auth.register') }}")
        </script>
    </body>
</html>
