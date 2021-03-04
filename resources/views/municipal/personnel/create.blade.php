@extends('templates-2.app')
@section('page-title', 'Dashboard')
@prepend('page-css')
@include('templates.select-option')
@endpush
@section('content')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xxl:col-span-12 grid grid-cols-12 gap-6">
        <!-- BEGIN: Add New Personnel -->
        <div class="col-span-12 mt-8">
            {{-- @include('templates.error') --}}
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Add New Personnel
                </h2>
                <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i>
                    Reload Data </a>
            </div>
            <div class="grid grid-cols mt-5">
                <div class="intro-y col-span-12 lg:col-span-6">
                    @if(Session::has('success'))
                    <div class="intro-y col-span-12 md:col-span-6">
                        <div class="box">
                            <div class="flex flex-col lg:flex-row items-center p-5 bg-theme-9 rounded">
                                <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                                    <p class="font-medium mb-2 text-white">Personnel Successfully Added!</p>
                                    <div class="text-gray-600 text-xs">
                                        <a target="_blank" href="{{ route('municipal.print.qr', Session::get('success')) }}"
                                            class="button button--md text-white bg-theme-1 mr-2">View Personnel I.D</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6">
                        <i data-feather="alert-circle" class="w-6 h-6 mr-2 text-white"></i>
                        <span class="text-white font-medium">All fields with * mark are required.</span>
                    </div>
                    @endif
                    <!-- BEGIN: Input -->
                    <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                            <h2 class="font-medium text-base mr-auto">
                                Personnel Information
                            </h2>
                        </div>
                        <div class="p-5" id="input">
                            <form method="POST" enctype="multipart/form-data" action="{{ route('municipal-personnel.store') }}"
                                class="preview">
                                @csrf
                                <div class="flex flex-col md:flex-row border-b border-gray-200 pb-4 mb-4">
                                    <div class="flex-1 flex flex-col md:flex-row">
                                        <div class="w-full flex-1 mx-2">
                                            <label>
                                                Firstname
                                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                            </label>

                                            <div
                                                class="p-1 bg-white flex border rounded  {{ $errors->has('firstname')  ? 'border-red-500' : '' }}">
                                                <input
                                                    class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                                                    type="text" placeholder="e.g. Christopher" aria-invalid="true"
                                                    name="firstname" value="{{  old('firstname') }}">
                                            </div>
                                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">Required, at
                                                least 3 characters</span>
                                        </div>
                                        <div class="w-full flex-1 mx-2">
                                            Middlename
                                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                            <div
                                                class="p-1 bg-white flex border {{ $errors->has('middlename')  ? 'border-red-500' : '' }} rounded">
                                                <input
                                                    class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                                                    type="text" placeholder="e.g. Platino" name="middlename"
                                                    value="{{  old('middlename') }}">
                                            </div>
                                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">Required, at
                                                least 2 characters</span>
                                        </div>

                                        <div class="w-full flex-1 mx-2">
                                            Lastname
                                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                            <div
                                                class="p-1 bg-white flex border {{ $errors->has('lastname')  ? 'border-red-500' : '' }} rounded">
                                                <input
                                                    class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                                                    type="text" placeholder="e.g. Vistal" name="lastname"
                                                    value="{{  old('lastname') }}">
                                            </div>
                                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">Required, at
                                                least 2 characters</span>
                                        </div>

                                        <div class="w-full flex-1 mx-2">
                                            Suffix
                                            <div class="p-1 bg-white flex border rounded">
                                                <input placeholder="Enter Suffix"
                                                    class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                                                    type="text" maxlength="3" placeholder="e.g. Jr" name="suffix"
                                                    value="{{  old('suffix') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-full flex-1 mx-2">
                                    <label>
                                        Date of Birth <span
                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                    </label>
                                    <div
                                        class=" p-1 bg-white flex border {{ $errors->has('date_of_birth')  ? 'border-red-500' : 'border' }} rounded">
                                        <input name="date_of_birth" placeholder="Date of Birth"
                                            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                                            type="date" value="{{  old('date_of_birth') }}">
                                    </div>
                                </div>
                                <div class="mb-2"></div>

                                <div class="mb-2 flex-1 flex flex-col md:flex-row">
                                    <div class="w-full flex-1 mx-2">
                                        <label for="">
                                            Barangay
                                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                        </label>
                                        <div
                                            class="bg-white {{ $errors->has('barangay') ? 'rounded border border-red-500' : 'p-1' }}">
                                            <select
                                                class="select2 input border p-2 px-2 appearance-none outline-none w-full text-gray-800 "
                                                name="barangay" id="barangay">
                                                <option selected disabled>Select Barangay</option>
                                                @foreach($barangays as $barangay)
                                                    <option {{ old('barangay') == $barangay->code ? 'selected' : '' }} value="{{ $barangay->code }}">{{ $barangay->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-red-500 text-xs">{{  $errors->first('barangay') }}</span>
                                    </div>
                                </div>

                                <div class="w-full flex-1 mx-2">
                                    <label for="">
                                        Temporary Address
                                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                    </label>
                                    <div
                                        class="p-1 bg-white flex border {{  $errors->has('temporary_address') ? 'border-red-500' : '' }} rounded rounded">
                                        <textarea placeholder="e.g. Purok Paradise 950"
                                            class="p-1 px-2 appearance-none outline-none w-full text-gray-800" rows="5"
                                            name="temporary_address">{{  old('temporary_address') }}</textarea>
                                    </div>
                                    <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                        Required, atleast 5 characters
                                    </span>
                                    <div class="mb-2"></div>
                                </div>

                                <div class="w-full flex-1 mx-2">

                                    <label for="">
                                        Permanent Address
                                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                    </label>
                                    <div
                                        class="p-1 bg-white flex border {{  $errors->has('address') ? 'border-red-500' : '' }} rounded">
                                        <textarea placeholder="e.g. Purok Paradise 950"
                                            class="p-1 px-2 appearance-none outline-none w-full text-gray-800" rows="5"
                                            name="address">{{  old('address') }}</textarea>
                                    </div>
                                    <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                        Required, atleast 5 characters
                                    </span>
                                    <div class="mb-2"></div>
                                </div>

                                <div class="mb-2 flex-1 flex flex-col md:flex-row">
                                    <div class="w-full flex-1 mx-2">
                                        <label> Sex
                                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                                *
                                            </span>
                                        </label>
                                        <div class=" p-1 bg-white flex">
                                            <select
                                                class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800  border {{  $errors->has('gender') ? 'border-red-500' : '' }}"
                                                name="gender">
                                                <option {{ old('gender') == 'Male' ? 'selected' : '' }} value="Male">
                                                    Male</option>
                                                <option {{ old('gender') == 'Female' ? 'selected' : '' }}
                                                    value="Female">Female</option>
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
                                            <select
                                                class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 border {{  $errors->has('status') ? 'border-red-500' : '' }}"
                                                name="status">
                                                @foreach($civil_status as $status)
                                                <option {{ old('status') == $status ? 'selected' : '' }}
                                                    value={{ $status }}>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-2 flex-1 flex flex-col md:flex-row">
                                    <div class="w-full flex-1 mx-2">
                                        Email
                                        <div class=" p-1 bg-white flex">
                                            <input
                                                class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800"
                                                type="email" placeholder="e.g. user@gmail.com" name="email"
                                                value="{{  old('email') }}">
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
                                            <input
                                                class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 border {{  $errors->has('phone_number') ? 'border-red-500' : '' }}"
                                                type="text" placeholder="e.g.+639193693499" name="phone_number"
                                                value="{{  old('phone_number') }}">
                                        </div>

                                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                            Required, Please include country code e.g. +639
                                        </span>

                                    </div>

                                    <div class="w-full flex-1 mx-2">
                                        Landline Number
                                        <div class="p-1 bg-white">
                                            <input
                                                class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800"
                                                type="text" placeholder="e.g. 8123-4567" name="landline_number"
                                                value="{{  old('landline_number') }}">
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
                                                type="text" placeholder="Enter username" name="username"
                                                value="{{  old('username') }}">
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
                                                type="password" name="password" value="{{ old('password') }}"
                                                placeholder="Enter password">
                                        </div>

                                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                            {{ $errors->first('password') }}
                                        </span>

                                    </div>

                                    <div class="w-full flex-1 mx-2">
                                        MPIN
                                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                            *
                                        </span>
                                        <div class="p-1 bg-white">
                                            <input
                                                class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 {{  $errors->has('mpin') ? 'border-red-500' : '' }}"
                                                placeholder="Enter MPIN" name="mpin" value="{{ old('mpin') }}"
                                                maxlength="4" type="password">
                                        </div>
                                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                            {{ $errors->first('mpin') }}
                                        </span>
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
                                        <input
                                            class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 border {{  $errors->has('image') ? 'border-red-500' : '' }}"
                                            type="file" name="image">
                                    </div>
                                    <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                        Required, attach only image file
                                    </span>
                                </div>

                                <div class="flex lg:justify-end">
                                    <button type="submit" class="button bg-theme-1 text-white w-auto">Add New
                                        Personnel</button>
                                    @if(Session::has('success'))
                                    <button type="submit" class="ml-2 button bg-green-500 text-white btn--md">View
                                        Generated QR</button>
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
@endsection
