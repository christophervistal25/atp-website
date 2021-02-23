
<!DOCTYPE html>
<!--
Template Name: Midone - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="/dist/images/logo.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <title>Register - Midone - Tailwind HTML Admin Template</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="/dist/css/app.css" />
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="login">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Register Info -->
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="" class="-intro-x flex items-center pt-5">
                        <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="/dist/images/logo.svg">
                        <span class="text-white text-lg ml-3"> <span class="font-medium">{{  config('app.name') }}</span> </span>
                    </a>
                    <div class="my-auto">
                        <img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="/dist/images/illustration.svg">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            A few more clicks to 
                            <br>
                            sign up to your account.
                        </div>
                    </div>
                </div>
                <!-- END: Register Info -->
                <!-- BEGIN: Register Form -->
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Sign Up
                        </h2>
                        <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
                        <form method="POST" action="{{  route('auth.register') }}">
                            @csrf
                            <div class="intro-x mt-8">
                                
                                <input type="text" class=" login__input input input--lg border border-gray-300 block {{  $errors->has('firstname')  ? 'border-theme-6' : 'intro-x' }}" placeholder="First Name" name="firstname" value="{{ old('firstname') }}">
                                <span class="text-theme-6">{{  $errors->first('firstname') }}</span>
                                
                                <input type="text" class=" login__input input input--lg border border-gray-300 block mt-4 {{  $errors->has('middlename') ? 'border-theme-6' : 'intro-x' }}" placeholder="Middle Name" name="middlename" value="{{  old('middlename') }}">
                                <span class="text-theme-6">{{  $errors->first('middlename') }}</span>

                                <input type="text" class=" login__input input input--lg border border-gray-300 block mt-4 {{  $errors->has('lastname') ? 'border-theme-6' : 'intro-x' }}" placeholder="Last Name" name="lastname" value="{{  old('lastname') }}">
                                <span class="text-theme-6">{{  $errors->first('lastname') }}</span>
                                
                                <div class="mt-4">
                                    <label>Date of Birth</label>

                                    <input type="date" class=" login__input input input--lg border border-gray-300 block {{ $errors->has('date_of_birth') ? 'border-theme-6' : 'intro-x' }}" placeholder="date_of_birth" name="date_of_birth" value="{{  old('date_of_birth') }}">

                                    <span class="text-theme-6">{{  $errors->first('date_of_birth') }}</span>
                                </div>
                                


                                <input type="text" class=" login__input input input--lg border border-gray-300 block mt-4 {{  $errors->has('username') ? 'border-theme-6' : 'intro-x' }}" placeholder="Username" name="username" value={{ old('username') }}>
                                <span class="text-theme-6">{{  $errors->first('username') }}</span>

                                <input type="number" class=" login__input input input--lg border border-gray-300 block mt-4 {{  $errors->has('phone_number') ? 'border-theme-6' : 'intro-x' }}" placeholder="Phone Number" name="phone_number" value={{ old('phone_number') }}>
                                <span class="text-theme-6">{{  $errors->first('phone_number') }}</span>

                                <input type="password" class=" login__input input input--lg border border-gray-300 block mt-4 {{  $errors->has('password') ? 'border-theme-6' : 'intro-x' }}" placeholder="Password" name="password">
                                <span class="text-theme-6">{{  $errors->first('password') }}</span>

                                <input type="password" class=" login__input input input--lg border border-gray-300 block mt-4 {{  $errors->has('password') ? 'border-theme-6' : 'intro-x' }}" placeholder="Password Confirmation" name="password_confirmation">
                            </div>

                            <div class="intro-x flex items-center text-gray-700 mt-4 text-xs sm:text-sm">
                                <input type="checkbox" class="input border mr-2" id="remember-me">
                                <label class="cursor-pointer select-none" for="remember-me">I agree to the {{ config('app.name') }}</label>
                                <a class="text-theme-1 ml-1" href="">Privacy Policy</a>. 
                            </div>

                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <button type="submit" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">Register</button>
                                <button type="button" id="btn-sign-in"  class="button button--lg w-full xl:w-32 text-gray-700 border border-gray-300 mt-3 xl:mt-0">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END: Register Form -->
            </div>
        </div>
        <!-- BEGIN: JS Assets-->
        <script src="/dist/js/app.js"></script>
        <!-- END: JS Assets-->
        <script>
            $('#btn-sign-in').click((e) => window.location.href = "{{ route('login') }}")
        </script>
    </body>
</html>