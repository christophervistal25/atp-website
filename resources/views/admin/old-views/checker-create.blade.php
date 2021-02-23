
@extends('admin.layouts.app')
@section('page-small-title','Checker')
@section('page-title','Edit Checker')
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
    <form method="POST" id="formUpdateChecker" action="{{ route('checker.update', $checker->id) }}" >
    @csrf
    @method('PUT')
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
                                <input type="text" class="form-control {{ $errors->has('username')  ? 'is-invalid' : ''}}" id="username" name="username" placeholder="Enter Username" value="{{ old('username') ?? $checker->username }}">
                                @if($errors->has('username'))
                                <small  class="form-text text-danger">
                                    {{ $errors->first('username') }} </small>
                            @endif


                            <div class="form-group mt-1">
                            <label for="firstname">Firstname</label>
                            <input type="text" class="form-control {{ $errors->has('firstname')  ? 'is-invalid' : ''}}" id="firstname" name="firstname" placeholder="Enter Firstname" value="{{ old('firstname') ?? $checker->firstname }}">
                            @if($errors->has('firstname'))
                                <small  class="form-text text-danger">
                                    {{ $errors->first('firstname') }} </small>
                            @endif

                            </div>

                            <div class="form-group">
                                <label for="middlename">Middlename</label>
                                <input type="text" class="form-control {{ $errors->has('middlename')  ? 'is-invalid' : ''}} " id="middlename" name="middlename" placeholder="Enter Middlename" value="{{ old('middlename') ?? $checker->middlename }}">
                                @if($errors->has('middlename'))
                                <small  class="form-text text-danger">
                                    {{ $errors->first('middlename') }} </small>
                            @endif
                            </div>

                            <div class="form-group">
                                <label for="lastname">Lastname</label>
                                <input type="text" class="form-control {{ $errors->has('lastname')  ? 'is-invalid' : ''}}" id="lastname" name="lastname" placeholder="Enter Lastname" value="{{ old('lastname') ?? $checker->lastname }}">

                                @if($errors->has('lastname'))
                                    <small  class="form-text text-danger">
                                    {{ $errors->first('lastname') }} </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="suffix">Suffix</label>
                                <input type="text" maxlength="3" class="form-control {{ $errors->has('suffix')  ? 'is-invalid' : ''}}" id="suffix" name="suffix" placeholder="e.g Jr." value="{{ old('suffix')  ?? $checker->suffix }}">
                                @if($errors->has('suffix'))
                                    <small  class="form-text text-danger">
                                    {{ $errors->first('suffix') }} </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password">Password <small class="text-info">(Filled this field if you want to change the checker password.)</small></label>
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
                                <input type="text"  class="form-control {{ $errors->has('phone_number')  ? 'is-invalid' : ''}}" id="phone_number" name="phone_number"  value="{{ old('phone_number')  ?? $checker->phone_number }}">
                                @if($errors->has('phone_number'))
                                    <small  class="form-text text-danger">
                                    {{ $errors->first('phone_number') }} </small>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-lg-3 pr-0">
                                    <div class="form-group">
                                        <label class="text-info">&nbsp;</label>
                                       <input type="text" class="form-control border-right-0" placeholder="Search for municipality" id="filterMunicipality">
                                    </div>
                                </div>

                                <div class="col-lg-9 pl-0">
                                    <label>Municipalities</label>
                                    <div class="form-group">
                                        <select name="city" id="cities" class="form-control">
                                            @foreach($cities as $city)
                                            @if($city->code == $checker->municipal_code)
                                                <option selected  value="{{ $city->code }}">{{ $city->name }}</option>
                                                @else
                                                <option  value="{{ $city->code }}">{{ $city->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                            <div class="float-right">
                                <button type="button" class="btn btn-success" id="btnUpdateChecker">Update Checker</button>
                            </div>

                            <div class="clearfix"></div>
                    </div>
                </div>
            </div>
    </form>
</section>
@push('page-scripts')
<script>
    $(document).ready(function () {
        let isClicked = false;
        let filterMunicipal = (keyword) => {

            // If the user leave the field blank then request for all city.
            if(!keyword) {
                keyword = 'all';
            }
            // Clear all the child option of select city
            $('#cities').find('option')
            .remove()
            .end()

            $.ajax({
                url : `/api/municipal/filter/${keyword}`,
                success : function (response) {
                    if(response.length !== 0) {
                        response.forEach((city) => {
                            $('#cities').append(`<option value=${city.code}>${city.name}</option>`)
                        });
                    } else {
                        alert('No results.')
                    }
                }
            });
        };

        $('#filterMunicipality').keyup(function (e) {
            if(e.key.toLowerCase() === 'enter') {
                filterMunicipal(e.target.value);
            }
        });

        $('#formUpdateChecker').submit(function (e) {
        });

        $('#btnUpdateChecker').click(function (e) {
            $('#formUpdateChecker').submit();
        })

    });
</script>
@endpush
@endsection
