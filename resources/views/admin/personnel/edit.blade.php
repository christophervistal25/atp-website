@extends('templates-2.app')
@section('page-title', 'Edit Personnel')
@section('content')
 <!-- BEGIN: Content -->
 <div class="content">
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-12 grid grid-cols-12 gap-6">
            <!-- BEGIN: Edit Personnel -->
            <div class="col-span-12 mt-8">
                {{-- @include('templates.error') --}}
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Edit <span class="capitalize">{{  strtolower($personnel->firstname) }}'s</span> Information
                    </h2>
                    <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
                </div>
                @if(Session::has('success'))
                    <div class="intro-y col-span-12 md:col-span-6">
                        <div class="box">
                            <div class="flex flex-col lg:flex-row items-center p-5 bg-theme-9 rounded">
                                <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                                    <p class="font-medium mb-2 text-white">Information of
                                        <span class="capitalize">
                                            {{ strtolower($personnel->firstname) }}
                                        </span> successfully update</p>
                                    <div class="text-gray-600 text-xs">
                                        <a target="_blank" href="{{ route('admin.print.qr', Session::get('success')) }}" class="button button--md text-white bg-theme-1 mr-2">View Personnel I.D</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="grid grid-cols mt-5">
                    <div class="intro-y col-span-12 lg:col-span-6">
                        <!-- BEGIN: Input -->
                        <div class="intro-y box">
                            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                                <h2 class="font-medium text-base mr-auto">
                                    Personnel Information
                                </h2>
                            </div>
                            <div class="p-5" id="input">
                                <form method="POST" enctype="multipart/form-data" action="{{ route('personnel.update', $personnel->id) }}" class="preview">
                                    @csrf
                                    @method('PUT')
                                    <div class="flex flex-col md:flex-row border-b border-gray-200 pb-4 mb-4">
                                        <div class="flex-1 flex flex-col md:flex-row">
                                            <div class="w-full flex-1 mx-2">
                                                <label>
                                                    Firstname
                                                    <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                                </label>

                                                <div class="p-1 bg-white flex border rounded  {{ $errors->has('firstname')  ? 'border-red-500' : '' }}">
                                                    <input class="p-1 px-2 appearance-none outline-none w-full text-gray-800" type="text" placeholder="e.g. Christopher" aria-invalid="true" name="firstname" value="{{  old('firstname') ?? $personnel->firstname }}">
                                                </div>
                                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                                    @if($errors->has('firstname'))
                                                        {{  $errors->first('firstname') }}
                                                    @else
                                                    Required, at least 3 characters
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="w-full flex-1 mx-2">
                                                Middlename
                                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                                <div class="p-1 bg-white flex border {{ $errors->has('middlename')  ? 'border-red-500' : '' }} rounded">
                                                    <input class="p-1 px-2 appearance-none outline-none w-full text-gray-800" type="text" placeholder="e.g. Platino" name="middlename" value="{{ old('middlename') ?? $personnel->middlename }}">
                                                </div>
                                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                                    <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                                        @if($errors->has('middlename'))
                                                            {{  $errors->first('middlename') }}
                                                        @else
                                                        Required, at least 3 characters
                                                        @endif
                                                    </span>
                                                </span>
                                            </div>

                                            <div class="w-full flex-1 mx-2">
                                                Lastname
                                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                                <div class="p-1 bg-white flex border {{ $errors->has('lastname')  ? 'border-red-500' : '' }} rounded">
                                                    <input class="p-1 px-2 appearance-none outline-none w-full text-gray-800" type="text" placeholder="e.g. Vistal" name="lastname" value="{{  old('lastname') ?? $personnel->lastname }}">
                                                </div>
                                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                                    @if($errors->has('lastname'))
                                                        {{  $errors->first('lastname') }}
                                                    @else
                                                    Required, at least 3 characters
                                                    @endif
                                                </span>
                                            </div>

                                            <div class="w-full flex-1 mx-2">
                                                Suffix
                                                <div class="p-1 bg-white flex border rounded">
                                                    <input placeholder="Enter Suffix" class="p-1 px-2 appearance-none outline-none w-full text-gray-800" type="text" maxlength="3" placeholder="e.g. Jr" name="suffix" value="{{  old('suffix') ?? $personnel->suffix }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-full flex-1 mx-2">
                                        <label>
                                            Date of Birth <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                        </label>
                                        <div class=" p-1 bg-white flex border {{ $errors->has('date_of_birth')  ? 'border-red-500' : 'border' }} rounded">
                                            <input name="date_of_birth" placeholder="Date of Birth" class="p-1 px-2 appearance-none outline-none w-full text-gray-800" type="date" value="{{  old('date_of_birth') ?? $personnel->date_of_birth }}">
                                        </div>
                                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                            @if($errors->has('date_of_birth'))
                                                {{  $errors->first('date_of_birth') }}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="mb-2"></div>

                                    <div class="mb-2 flex-1 flex flex-col md:flex-row">
                                        <div class="w-full flex-1 mx-2">
                                            <label>
                                                Province
                                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                            </label>
                                            <div class=" p-1 bg-white flex">
                                                <select
                                                class="input border {{ $errors->has('province')  ? 'border-red-500' : '' }} p-2 px-2 appearance-none outline-none w-full text-gray-800" name="province" id="province">
                                                    @foreach($provinces as $province)
                                                        <option
                                                            {{ $personnel->province_code == $province->code ? 'selected' : '' }}
                                                            value="{{ $province->code }}"> {{ $province->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="w-full flex-1 mx-2">
                                            <label for="">
                                                City
                                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                            </label>
                                            <div class="p-1 bg-white flex ">
                                                <select class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 {{  $errors->has('city') ? 'border-red-500' : '' }}" name="city" id="cities" value="{{  old('city') }}">
                                                    <option selected value="{{  $personnel->city_code }}">{{ $personnel->city->name }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="w-full flex-1 mx-2">
                                            <label for="">
                                                Barangay
                                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                            </label>
                                            <div class="p-1 bg-white">
                                                <select class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 {{  $errors->has('barangay') ? 'border-red-500' : '' }}" name="barangay" id="barangay" value="{{  old('barangay') }}">
                                                    <option selected value="{{  $personnel->barangay_code }}">{{ $personnel->barangay->name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-full flex-1 mx-2">
                                        <label for="">
                                            Temporary Address
                                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                        </label>
                                        <div class="p-1 bg-white flex border {{  $errors->has('temporary_address') ? 'border-red-500' : '' }} rounded rounded">
                                            <textarea placeholder="e.g. Purok Paradise 950" class="p-1 px-2 appearance-none outline-none w-full text-gray-800" rows="5" name="temporary_address">{{  old('temporary_address') ?? $personnel->temporary_address }}</textarea>
                                        </div>

                                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                            @if($errors->has('temporary_address'))
                                                {{  $errors->first('temporary_address') }}
                                            @else
                                                    Required, atleast 5 characters
                                            @endif
                                        </span>
                                        <div class="mb-2"></div>
                                    </div>

                                    <div class="w-full flex-1 mx-2">

                                        <label for="">
                                            Permanent Address
                                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                        </label>
                                        <div class="p-1 bg-white flex border {{  $errors->has('address') ? 'border-red-500' : '' }} rounded">
                                            <textarea placeholder="e.g. Purok Paradise 950"  class="p-1 px-2 appearance-none outline-none w-full text-gray-800" rows="5" name="address">{{  old('address') ?? $personnel->address }}</textarea>
                                        </div>
                                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                            @if($errors->has('address'))
                                                {{ $errors->first('address') }}
                                            @else
                                                    Required, atleast 5 characters
                                            @endif
                                        </span>
                                        <div class="mb-2"></div>
                                    </div>

                                    <div class="mb-2 flex-1 flex flex-col md:flex-row">
                                        <div class="w-full flex-1 mx-2">
                                            <label>                                                Sex
                                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                                    *
                                                </span>
                                            </label>
                                            <div class=" p-1 bg-white flex">
                                                <select class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800  border {{  $errors->has('gender') ? 'border-red-500' : '' }}" name="gender"
                                                    value="{{ old('gender') ?? $personnel->gender }}">
                                                        <option {{  strtolower($personnel->gender) == 'male' ? 'selected' : ''  }}  value="Male">Male</option>
                                                        <option {{ strtolower($personnel->gender) == 'female' ? 'selected' : ''  }} value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="w-full flex-1 mx-2">
                                            <label>
                                                Status
                                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                                    *
                                                </span>
                                            </label>
                                            <div class="p-1 bg-white flex ">
                                                <select class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 border {{  $errors->has('status') ? 'border-red-500' : '' }}" name="status" value="{{  old('status') }}">
                                                    @foreach($civil_status as $status)
                                                    <option {{ $personnel->civil_status == $status ? 'selected' : '' }} value="{{ $status }}">{{ $status }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-2 flex-1 flex flex-col md:flex-row">
                                        <div class="w-full flex-1 mx-2">
                                            Email
                                            <div class=" p-1 bg-white flex">
                                                <input class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800" type="email" placeholder="e.g. user@gmail.com" name="email" value="{{  old('email') ?? $personnel->email }}">
                                            </div>
                                        </div>
                                        <div class="w-full flex-1 mx-2">
                                            <label>
                                                Mobile Number
                                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                                    *
                                                </span>
                                            </label>
                                            <div class="p-1 bg-white flex ">
                                                <input class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 border {{  $errors->has('phone_number') ? 'border-red-500' : '' }}" type="text" placeholder="e.g.+639193693499" name="phone_number" value="{{ old('phone_number') ?? $personnel->phone_number }}">
                                            </div>

                                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                                @if($errors->has('phone_number'))
                                                    {{  $errors->first('phone_number') }}
                                                @else
                                                    Required, Please include country code e.g. +639
                                                @endif
                                            </span>

                                        </div>

                                        <div class="w-full flex-1 mx-2">
                                            Landline Number
                                            <div class="p-1 bg-white">
                                                <input class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800" type="text" placeholder="e.g. 8123-4567" name="landline_number" value="{{  old('landline_number') ?? $personnel->landline_number }}">
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                <div class="mt-2 flex-1 flex flex-col md:flex-row">

                                    <div class="w-full flex-1 mx-2">
                                        Username
                                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                            *
                                        </span>
                                        <div class=" p-1 bg-white flex">
                                            <input
                                                class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 {{  $errors->has('username') ? 'border-red-500' : '' }}"
                                                type="text" placeholder="Enter username" name="username" value="{{  old('username') ?? $personnel->account->username }}">
                                        </div>
                                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                            {{ $errors->first('username') }}
                                        </span>
                                    </div>
                                    <div class="w-full flex-1 mx-2">
                                        <label>
                                            Password
                                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                                *
                                            </span>
                                        </label>
                                        <div class="p-1 bg-white flex ">
                                            <input
                                                class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 border {{  $errors->has('password') ? 'border-red-500' : '' }}"
                                                type="password" name="password" value="{{ old('password') }}" placeholder="Enter password">
                                        </div>

                                        @if($errors->has('password'))
                                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                                {{ $errors->first('password') }}
                                            </span>
                                        @else
                                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-theme-1">
                                                Optional
                                            </span>
                                        @endif

                                    </div>

                                    <div class="w-full flex-1 mx-2">
                                        MPIN
                                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                            *
                                        </span>
                                        <div class="p-1 bg-white">
                                            <input
                                                class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 {{  $errors->has('mpin') ? 'border-red-500' : '' }}"
                                                placeholder="Enter MPIN"
                                                name="mpin"
                                                value="{{ old('mpin') }}"
                                                maxlength="4"
                                                type="password">
                                        </div>
                                        @if($errors->has('mpin'))
                                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                                {{ $errors->first('mpin') }}
                                            </span>
                                        @else
                                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-theme-1">
                                                Optional
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="w-full flex-1">
                                    <div class="mx-2 my-2">
                                        <div class="mt-2">
                                            <input type="checkbox" class="input input--switch border" name="use_default">
                                        </div>
                                        <label class="text-theme-3 font-medium">Use default Passwod and MPIN for this account</label>

                                    </div>
                                </div>


                                    <div class="w-full flex-1 mx-2">
                                        <label>
                                            Image
                                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                                *
                                            </span>
                                        </label>

                                        <div class="p-1 bg-white flex  rounded">
                                            <input class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 border {{  $errors->has('image') ? 'border-red-500' : '' }}"" type="file" name="image">
                                        </div>
                                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                            Required, attach only image file
                                        </span>
                                    </div>

                                    <div class="flex lg:justify-end">
                                        <button type="submit" class="button bg-theme-9 shadow text-white w-auto">Update <span class="capitalize">{{ strtolower($personnel->firstname) }}</span>'s Information</button>
                                        @if(Session::has('success'))
                                            <a href="{{ route('admin.print.qr', Session::get('success')) }}" class="ml-2 button bg-green-500 text-white btn--md">View Generated QR</a>
                                        @endif
                                    </div>

                                </form>

                                </div>
                            </div>
                        </div>
                        <!-- END: Input -->
                    </div>
                </div>
            </div>
            <!-- END: Add New Personnel -->
        </div>
    </div>
</div>
<!-- END: Content -->
@push('page-scripts')
<script>
    $(document).ready(() => {

        const BASE_URL = '/api/province';

        // User Select Province then populate all data for province.
        $('#province').change((e) => {
            let provinceCode = e.target.value;
            let elementCities = $('#cities');
            // Make an AJAX request to get all city filtered by selected province.
            $.ajax({
                url : `${BASE_URL}/municipal/${provinceCode}`,
                success : (response) => {
                    // Clear all option of cities select element
                    elementCities.find('option').remove();

                    // Iterate to all city by province code and display to select
                    response.municipals.forEach((municipal) => {
                        elementCities.append(`<option value="${municipal.code}">${municipal.name}</option>`);
                    });

                }

            });
        });


        // User Select City then populate all data for barangays
        $('#cities').change((e) =>  {
            let selectedCityCode = e.target.value;
            let barangayElement = $('#barangay');

            // Make an AJAX request to get all barangay filtered by selected city.
            $.ajax({
                url : `${BASE_URL}/barangay/${selectedCityCode}`,
                success : (response) =>  {
                    // Clear all option of barangay select element
                    barangayElement.find('option').remove();

                    // Iterate to all barangay by city code and display to select
                    response.barangays.forEach((barangay) =>  {
                        $('#barangay').append(`<option value="${barangay.code}">${barangay.name}</option>`);
                    });

                }
            });

        });
    });
</script>
@endpush
@endsection
