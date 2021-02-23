<!DOCTYPE html>
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

