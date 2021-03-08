@extends('user.templates.app')
@section('page-title', 'Edit your account credentials')
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
                        Settings
                    </h2>
                    <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw"
                            class="w-4 h-4 mr-3"></i> Reload Data </a>
                </div>
                @if(Session::has('success'))
                <div class="intro-y col-span-12 md:col-span-6">
                    <div class="box">
                        <div class="flex flex-col lg:flex-row items-center p-5 bg-theme-9 rounded">
                            <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                                <p class="font-medium text-white">{{ Session::get('success') }}</p>
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
                                    Account Credentials
                                </h2>
                            </div>
                            <div class="p-5" id="input">
                                <form action="{{ route('user.account.update') }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="w-full flex-1 mx-2">
                                        Username
                                        <div class=" p-1 bg-white flex">
                                            <input
                                                class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 {{  $errors->has('username') ? 'border-red-500' : '' }}"
                                                type="text" placeholder="Enter username" name="username"
                                                value="{{ old('username') ?? $account->username }}">
                                        </div>
                                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                            {{ $errors->first('username') }}
                                        </span>
                                    </div>

                                    <div class="w-full flex-1 mx-2 my-3">
                                        Password
                                        <div class=" p-1 bg-white flex">
                                            <input
                                                class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 {{  $errors->has('password') ? 'border-red-500' : '' }}"
                                                type="password" placeholder="Enter Password" name="password"
                                                >
                                        </div>
                                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                            {{ $errors->first('password') }}
                                        </span>
                                    </div>

                                    <div class="w-full flex-1 mx-2">
                                        Re-type Password
                                        <div class=" p-1 bg-white flex">
                                            <input
                                                class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 "
                                                type="password" placeholder="Re-type password" name="password_confirmation"
                                                value="">
                                        </div>
                                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                            {{ $errors->first('password_confirmation') }}
                                        </span>
                                    </div>

                                    <div class="flex lg:justify-end">
                                        <input type="submit"  value="Update your account credentials" class="button bg-theme-9 text-white mt-2">
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
<script src="/dist/js/custom/select/select-province-city.js"></script>
@endpush
@endsection
