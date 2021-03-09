@extends('templates-2.app')
@section('page-title', 'Edit Personnel')
@section('content')
<!-- BEGIN: Content -->
<div class="content">
    <div class="grid grid-cols-12">
        <div class="col-span-12 xxl:col-span-12 grid grid-cols-12 gap-6">
            <!-- BEGIN: Edit Personnel -->
            <div class="col-span-12">
                {{-- @include('templates.error') --}}
                <div class="intro-y flex items-center h-10">
                    
                    <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw"
                    class="w-4 h-4 mr-3"></i> Reload Data </a>
                </div>
                @if(Session::has('success'))
                <div class="intro-y col-span-12 md:col-span-6">
                    <div class="box">
                        <div class="flex flex-col lg:flex-row items-center p-5 bg-theme-9 rounded">
                            <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                                    <p class="text-white">Information of
                                        <span class="capitalize">
                                            {{ strtolower($personnel->firstname) }}
                                        </span> Successfully Update
                                        <br>
                                        <a href="{{ route('admin.print.qr', Session::get('success')) }}" target="_blank" class="font-medium">
                                            <u>
                                                View Personnel I.D
                                            </u>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="grid grid-cols mt-5">
                        <div class="intro-y col-span-12 lg:col-span-6 box">
                            <!-- BEGIN: Input -->
                            <div class="flex items-center px-5 py-5 sm:py-0 border-b border-gray-200">
                                <h2 class="font-medium text-base truncate text-lg mr-auto">
                                Edit <span class="capitalize">{{  strtolower($personnel->firstname) }}'s</span> Information
                                </h2>
                                <div class="dropdown relative ml-auto sm:hidden">
                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal w-5 h-5 text-gray-700"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg> </a>
                                    <div class="nav-tabs dropdown-box mt-5 absolute w-40 top-0 right-0 z-20">
                                    </div>
                                </div>
                                <div class="nav-tabs ml-auto hidden sm:flex">
                                    <a data-toggle="tab" data-target="#personal-information" href="javascript:;" class="py-5 ml-6 active">Personel Information</a>
                                    <a data-toggle="tab" data-target="#last-week" href="javascript:;" class="py-5 ml-6">Others</a>
                                </div>
                            </div>
                            <div class="p-5">
                                <form method="POST" enctype="multipart/form-data" action="{{ route('personnel.update', $personnel->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="tab-content">
                                        <div class="tab-content__pane active" id="personal-information">
                                            @include('admin.personnel.edit-information')
                                        </div>
                                        <div class="tab-content__pane" id="last-week">
                                            @include('admin.personnel.edit-other-information')
                                        </div>
                                    </div>
                                    <div class="flex lg:justify-end">
                                        <button type="submit" class="button mr-2 mb-2 flex items-center justify-center bg-theme-9 text-white"> 
                                            <i data-feather="edit-3" class="w-4 mr-1"></i>
                                            Update <span class="capitalize ml-1">{{ strtolower($personnel->firstname) }}</span>'s Information 
                                        </button>
                                    </div>
                                </form>
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