
@extends('municipal.layouts.app')
@section('page-small-title','Checker')
@section('page-title','Update Checker')
@section('content')
<div class="mb-2">
    @if(Session::has('success'))
    <div class="card bg-success text-white shadow">
        <div class="card-body">{{ Session::get('success') }}</div>
    </div>
    @endif
    {{-- @include('templates.error') --}}
</div>
<section id="basic-alerts">
    <form method="POST"  action="{{ route('m-checker.update', $m_checker->id) }}" >
        @method('PUT')
        @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Checker Information</h4>
                        <a class="heading-elements-toggle">
                            <i class="la la-ellipsis-v font-medium-3"></i>
                        </a>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control {{ $errors->has('username')  ? 'is-invalid' : ''}}" id="username" name="username" placeholder="Enter Username" value="{{ $m_checker->username ?? old('username') }}">
                                @if($errors->has('username'))
                                <small  class="form-text text-danger">
                                    {{ $errors->first('username') }} </small>
                            @endif


                            <div class="form-group mt-1">
                            <label for="firstname">Firstname</label>
                            <input type="text" class="form-control {{ $errors->has('firstname')  ? 'is-invalid' : ''}}" id="firstname" name="firstname" placeholder="Enter Firstname" value="{{ $m_checker->firstname ?? old('firstname') }}">
                            @if($errors->has('firstname'))
                                <small  class="form-text text-danger">
                                    {{ $errors->first('firstname') }} </small>
                            @endif

                            </div>

                            <div class="form-group">
                                <label for="middlename">Middlename</label>
                                <input type="text" class="form-control {{ $errors->has('middlename')  ? 'is-invalid' : ''}} " id="middlename" name="middlename" placeholder="Enter Middlename" value="{{ $m_checker->middlename ?? old('middlename') }}">
                                @if($errors->has('middlename'))
                                <small  class="form-text text-danger">
                                    {{ $errors->first('middlename') }} </small>
                            @endif
                            </div>

                            <div class="form-group">
                                <label for="lastname">Lastname</label>
                                <input type="text" class="form-control {{ $errors->has('lastname')  ? 'is-invalid' : ''}}" id="lastname" name="lastname" placeholder="Enter Lastname" value="{{ $m_checker->lastname ?? old('lastname') }}">

                                @if($errors->has('lastname'))
                                    <small  class="form-text text-danger">
                                    {{ $errors->first('lastname') }} </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="suffix">Suffix</label>
                                <input type="text" maxlength="3" class="form-control {{ $errors->has('suffix')  ? 'is-invalid' : ''}}" id="suffix" name="suffix" placeholder="e.g Jr." value="{{ $m_checker->suffix ?? old('suffix') }}">
                                @if($errors->has('suffix'))
                                    <small  class="form-text text-danger">
                                    {{ $errors->first('suffix') }} </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" placeholder="Enter Password" class="form-control {{ $errors->has('password')  ? 'is-invalid' : ''}}" id="password" name="password"  value="{{ old('password') }}">
                                @if($errors->has('password'))
                                    <small  class="form-text text-danger">
                                    {{ $errors->first('password') }} </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Re-type Password</label>
                                <input type="password"  class="form-control {{ $errors->has('password_confirmation')  ? 'is-invalid' : ''}}" id="password_confirmation" name="password_confirmation"  value="{{ old('password_confirmation') }}">
                                @if($errors->has('password_confirmation'))
                                    <small  class="form-text text-danger">
                                    {{ $errors->first('password_confirmation') }} </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text"  class="form-control {{ $errors->has('phone_number')  ? 'is-invalid' : ''}}" id="phone_number" name="phone_number"  value="{{ $m_checker->phone_number ?? old('phone_number') }}">
                                @if($errors->has('phone_number'))
                                    <small  class="form-text text-danger">
                                    {{ $errors->first('phone_number') }} </small>
                                @endif
                            </div>

                        </div>
                            <div class="float-right">
                                <button type="submit" class="btn btn-success" id="btnSubmitNewChecker">Update Checker</button>
                            </div>

                            <div class="clearfix"></div>
                    </div>
                </div>
            </div>
    </form>
</section>
@endsection
