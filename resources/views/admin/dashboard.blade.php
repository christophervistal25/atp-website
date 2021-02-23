@extends('templates-2.app')
@section('page-title', 'Dashboard')
@section('content')
 <!-- BEGIN: Content -->
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-12 grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Statistics
                    </h2>
                    <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <a href="{{  route('personnel.index') }}">
                                <div class="report-box zoom-in">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="users" class="report-box__icon text-theme-10"></i>
                                            {{-- <div class="ml-auto">
                                                <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="33% Higher than last month"> 33% <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                            </div> --}}
                                        </div>
                                        <div class="text-3xl font-bold leading-8 mt-6">{{  $person_count }}</div>
                                        <div class="text-base text-gray-600 mt-1">People</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <a href="{{  route('municipal-account.index') }}">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="home" class="report-box__icon text-theme-9"></i>
                                        {{-- <div class="ml-auto">
                                            <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="22% Higher than last month"> 22% <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                        </div> --}}
                                    </div>
                                    <div class="text-3xl font-bold leading-8 mt-6">{{ $municipal_count }}</div>
                                    <div class="text-base text-gray-600 mt-1">Municipals account</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <a href="{{  route('checker.index') }}">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="user-check" class="report-box__icon text-theme-11"></i>
                                        {{-- <div class="ml-auto">
                                            <div class="report-box__indicator bg-theme-6 tooltip cursor-pointer" title="2% Lower than last month"> 2% <i data-feather="chevron-down" class="w-4 h-4"></i> </div>
                                        </div> --}}
                                    </div>
                                    <div class="text-3xl font-bold leading-8 mt-6">{{  $checker_count }}</div>
                                    <div class="text-base text-gray-600 mt-1">Checkers</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <a href="{{ route('establishment.index') }}">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="home" class="report-box__icon text-theme-12"></i>
                                        {{-- <div class="ml-auto">
                                            <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="12% Higher than last month"> 12% <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                        </div> --}}
                                    </div>
                                    <div class="text-3xl font-bold leading-8 mt-6">{{ $establishment_count }}</div>
                                    <div class="text-base text-gray-600 mt-1">Establishments</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- END: General Report -->
            
            <!-- BEGIN: Sales Report -->
            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Chart
                    </h2>
                    <div class="sm:ml-auto mt-3 sm:mt-0 relative text-gray-700">
                        <i data-feather="calendar" class="w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i>
                        <input type="text" data-daterange="true" class="datepicker input w-full sm:w-56 box pl-10">
                    </div>
                </div>
                <div class="intro-y box p-5 mt-12 sm:mt-5">
                    <div class="flex flex-col xl:flex-row xl:items-center">
                        <div class="flex">
                            <div>
                                <div class="text-theme-20 text-lg xl:text-xl font-bold">15,000</div>
                                <div class="text-gray-600">This Month</div>
                            </div>
                            {{-- <div class="w-px h-12 border border-r border-dashed border-gray-300 mx-4 xl:mx-6"></div>
                            <div>
                                <div class="text-gray-600 text-lg xl:text-xl font-medium">$10,000</div>
                                <div class="text-gray-600">Last Month</div>
                            </div> --}}
                        </div>
                        <div class="dropdown relative xl:ml-auto mt-5 xl:mt-0">
                            <button class="dropdown-toggle button font-normal border text-white relative flex items-center text-gray-700"> Filter by Category <i data-feather="chevron-down" class="w-4 h-4 ml-2"></i> </button>
                            <div class="dropdown-box mt-10 absolute w-40 top-0 xl:right-0 z-20">
                                <div class="dropdown-box__content box p-2 overflow-y-auto h-32"> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">PC & Laptop</a> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">Smartphone</a> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">Electronic</a> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">Photography</a> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">Sport</a> </div>
                            </div>
                        </div>
                    </div>
                    <div class="report-chart">
                        <canvas id="report-line-chart" height="160" class="mt-6"></canvas>
                    </div>
                </div>
            </div>
            <!-- END: Sales Report -->
            <!-- BEGIN: Weekly Top Seller -->
            <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Person's Temperature Chart
                    </h2>
                    {{-- <a href="" class="ml-auto text-theme-1 truncate">See all</a> --}}
                </div>
                <div class="intro-y box p-5 mt-5">
                    <canvas class="mt-3" id="test-chart" height="280"></canvas>
                    <div class="mt-8">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                            <span class="truncate">Normal</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">100</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="w-2 h-2 bg-theme-1 rounded-full mr-3"></div>
                            <span class="truncate">Fever</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">200</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
                            <span class="truncate">Severe</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">300</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Weekly Top Seller -->
            <!-- BEGIN: Sales Report -->
            <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Sales Report
                    </h2>
                    {{-- <a href="" class="ml-auto text-theme-1 truncate">See all</a> --}}
                </div>
                <div class="intro-y box p-5 mt-5">
                    <canvas class="mt-3" id="report-donut-chart" height="280"></canvas>
                    <div class="mt-8">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                            <span class="truncate">17 - 30 Years old</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">62%</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="w-2 h-2 bg-theme-1 rounded-full mr-3"></div>
                            <span class="truncate">31 - 50 Years old</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">33%</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
                            <span class="truncate">>= 50 Years old</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">10%</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Sales Report -->
        </div>
    </div>

    <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">
            COVID - 19 Updates
        </h2>
    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box py-10 sm:py-20 mt-5">
        <div class="flex justify-center">
            <button class="intro-y w-auto h-auto rounded-full button text-white bg-theme-1 mx-2 update-category" data-target="surigao-del-sur">SURIGAO DEL SUR</button>
            <button class="intro-y w-auto h-auto rounded-full button bg-gray-200 text-gray-600 mx-2 update-category" data-target="philippines">PHILIPPINES</button>
            <button class="intro-y w-auto h-auto rounded-full button bg-gray-200 text-gray-600 mx-2 update-category" data-target="worldwide">WORLD-WIDE</button>
        </div>
        <div class="px-5 mt-10">
            <div class="font-medium text-center text-lg" id="base-title">
                COVID-19 Updates SURIGAO DEL SUR</div>
                <div class="font-medium text-center text-xs" id="base-title">
                    Source : <a target="_blank" class="text-theme-1" href="https://covid19stats.ph/">Covid-19 Tracker Philippines</a>
                </div>
        </div>
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200">
            <div class="grid grid-cols-12 gap-4" id="surigao-del-sur">
                <div class=" col-span-12 sm:col-span-4">
                    <div class="intro-y flex-1 px-5 py-16  sm:col-span-4 ">
                        <i data-feather="user-plus" class="w-12 h-12 text-theme-1 mx-auto"></i> 
                        <div class="text-xl font-medium text-center mt-10 text-theme-1">Confirmed Cases</div>
                        <div class="flex justify-center">
                            <div class="relative text-5xl font-semibold mt-2 mx-auto" id="surigao-confirmed-case"> 
                                <svg width="15" viewBox="0 0 55 80" xmlns="http://www.w3.org/2000/svg" fill="rgb(45, 55, 72)" class="w-8 h-8">
                                <g transform="matrix(1 0 0 -1 0 80)">
                                    <rect width="10" height="20" rx="3">
                                        <animate attributeName="height" begin="0s" dur="4.3s" values="20;45;57;80;64;32;66;45;64;23;66;13;64;56;34;34;2;23;76;79;20" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="15" width="10" height="80" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s" values="80;55;33;5;75;23;73;33;12;14;60;80" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="30" width="10" height="50" rx="3">
                                        <animate attributeName="height" begin="0s" dur="1.4s" values="50;34;78;23;56;23;34;76;80;54;21;50" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="45" width="10" height="30" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s" values="30;45;13;80;56;72;45;76;34;23;67;30" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                </g>
                                </svg> 
                            </div>
                        </div>
                    </div>
                </div>
                    
                <div class=" col-span-12 sm:col-span-4">
                    <div class="intro-y flex-1 px-5 py-16  sm:col-span-4 ">
                        <i data-feather="user-check" class="w-12 h-12 text-theme-9 mx-auto"></i> 
                        <div class="text-xl font-medium text-center mt-10 text-theme-9">Recovered</div>
                        <div class="flex justify-center">
                            <div class="relative text-5xl font-semibold mt-2 mx-auto" id="surigao-recovered"> 
                                <svg width="15" viewBox="0 0 55 80" xmlns="http://www.w3.org/2000/svg" fill="rgb(45, 55, 72)" class="w-8 h-8">
                                <g transform="matrix(1 0 0 -1 0 80)">
                                    <rect width="10" height="20" rx="3">
                                        <animate attributeName="height" begin="0s" dur="4.3s" values="20;45;57;80;64;32;66;45;64;23;66;13;64;56;34;34;2;23;76;79;20" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="15" width="10" height="80" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s" values="80;55;33;5;75;23;73;33;12;14;60;80" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="30" width="10" height="50" rx="3">
                                        <animate attributeName="height" begin="0s" dur="1.4s" values="50;34;78;23;56;23;34;76;80;54;21;50" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="45" width="10" height="30" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s" values="30;45;13;80;56;72;45;76;34;23;67;30" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                </g>
                                </svg> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <div class="intro-y flex-1 px-5 py-16  sm:col-span-4 ">
                        <i data-feather="user-x" class="w-12 h-12 text-theme-6 mx-auto"></i> 
                        <div class="text-xl font-medium text-center mt-10 text-theme-6">Deaths</div>
                        <div class="flex justify-center">
                            <div class="relative text-5xl font-semibold mt-2 mx-auto" id="surigao-deaths"> 
                                <svg width="15" viewBox="0 0 55 80" xmlns="http://www.w3.org/2000/svg" fill="rgb(45, 55, 72)" class="w-8 h-8">
                                <g transform="matrix(1 0 0 -1 0 80)">
                                    <rect width="10" height="20" rx="3">
                                        <animate attributeName="height" begin="0s" dur="4.3s" values="20;45;57;80;64;32;66;45;64;23;66;13;64;56;34;34;2;23;76;79;20" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="15" width="10" height="80" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s" values="80;55;33;5;75;23;73;33;12;14;60;80" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="30" width="10" height="50" rx="3">
                                        <animate attributeName="height" begin="0s" dur="1.4s" values="50;34;78;23;56;23;34;76;80;54;21;50" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="45" width="10" height="30" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s" values="30;45;13;80;56;72;45;76;34;23;67;30" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                </g>
                                </svg> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-4 hidden" id="philippines">
                <div class=" col-span-12 sm:col-span-4">
                    <div class="intro-y flex-1 px-5 py-16  sm:col-span-4 ">
                        <i data-feather="user-plus" class="w-12 h-12 text-theme-1 mx-auto"></i> 
                        <div class="text-xl font-medium text-center mt-10 text-theme-1">Confirmed Cases</div>
                        <div class="flex justify-center">
                            <div class="relative text-5xl font-semibold mt-2 mx-auto" id="philippines-confirmed"> 
                                <svg width="15" viewBox="0 0 55 80" xmlns="http://www.w3.org/2000/svg" fill="rgb(45, 55, 72)" class="w-8 h-8">
                                <g transform="matrix(1 0 0 -1 0 80)">
                                    <rect width="10" height="20" rx="3">
                                        <animate attributeName="height" begin="0s" dur="4.3s" values="20;45;57;80;64;32;66;45;64;23;66;13;64;56;34;34;2;23;76;79;20" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="15" width="10" height="80" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s" values="80;55;33;5;75;23;73;33;12;14;60;80" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="30" width="10" height="50" rx="3">
                                        <animate attributeName="height" begin="0s" dur="1.4s" values="50;34;78;23;56;23;34;76;80;54;21;50" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="45" width="10" height="30" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s" values="30;45;13;80;56;72;45;76;34;23;67;30" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                </g>
                                </svg> 
                            </div>
                        </div>
                    </div>
                </div>
                    
                <div class=" col-span-12 sm:col-span-4">
                    <div class="intro-y flex-1 px-5 py-16  sm:col-span-4 ">
                        <i data-feather="user-check" class="w-12 h-12 text-theme-9 mx-auto"></i> 
                        <div class="text-xl font-medium text-center mt-10 text-theme-9">Recovered</div>
                        <div class="flex justify-center">
                            <div class="relative text-5xl font-semibold mt-2 mx-auto" id="philippines-recovered"> 
                                <svg width="15" viewBox="0 0 55 80" xmlns="http://www.w3.org/2000/svg" fill="rgb(45, 55, 72)" class="w-8 h-8">
                                <g transform="matrix(1 0 0 -1 0 80)">
                                    <rect width="10" height="20" rx="3">
                                        <animate attributeName="height" begin="0s" dur="4.3s" values="20;45;57;80;64;32;66;45;64;23;66;13;64;56;34;34;2;23;76;79;20" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="15" width="10" height="80" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s" values="80;55;33;5;75;23;73;33;12;14;60;80" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="30" width="10" height="50" rx="3">
                                        <animate attributeName="height" begin="0s" dur="1.4s" values="50;34;78;23;56;23;34;76;80;54;21;50" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="45" width="10" height="30" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s" values="30;45;13;80;56;72;45;76;34;23;67;30" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                </g>
                                </svg> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <div class="intro-y flex-1 px-5 py-16  sm:col-span-4 ">
                        <i data-feather="user-x" class="w-12 h-12 text-theme-6 mx-auto"></i> 
                        <div class="text-xl font-medium text-center mt-10 text-theme-6">Deaths</div>
                        <div class="flex justify-center">
                            <div class="relative text-5xl font-semibold mt-2 mx-auto" id="philippines-deaths"> 
                                <svg width="15" viewBox="0 0 55 80" xmlns="http://www.w3.org/2000/svg" fill="rgb(45, 55, 72)" class="w-8 h-8">
                                <g transform="matrix(1 0 0 -1 0 80)">
                                    <rect width="10" height="20" rx="3">
                                        <animate attributeName="height" begin="0s" dur="4.3s" values="20;45;57;80;64;32;66;45;64;23;66;13;64;56;34;34;2;23;76;79;20" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="15" width="10" height="80" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s" values="80;55;33;5;75;23;73;33;12;14;60;80" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="30" width="10" height="50" rx="3">
                                        <animate attributeName="height" begin="0s" dur="1.4s" values="50;34;78;23;56;23;34;76;80;54;21;50" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="45" width="10" height="30" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s" values="30;45;13;80;56;72;45;76;34;23;67;30" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                </g>
                                </svg> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="grid grid-cols-12 gap-4 hidden" id="worldwide">
                <div class=" col-span-12 sm:col-span-4">
                    <div class="intro-y flex-1 px-5 py-16  sm:col-span-4 ">
                        <i data-feather="user-plus" class="w-12 h-12 text-theme-1 mx-auto"></i> 
                        <div class="text-xl font-medium text-center mt-10 text-theme-1">Confirmed Cases</div>
                        <div class="flex justify-center">
                            <div class="relative text-5xl font-semibold mt-2 mx-auto" id="world-wide-confirmed"> 
                                <svg width="15" viewBox="0 0 55 80" xmlns="http://www.w3.org/2000/svg" fill="rgb(45, 55, 72)" class="w-8 h-8">
                                <g transform="matrix(1 0 0 -1 0 80)">
                                    <rect width="10" height="20" rx="3">
                                        <animate attributeName="height" begin="0s" dur="4.3s" values="20;45;57;80;64;32;66;45;64;23;66;13;64;56;34;34;2;23;76;79;20" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="15" width="10" height="80" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s" values="80;55;33;5;75;23;73;33;12;14;60;80" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="30" width="10" height="50" rx="3">
                                        <animate attributeName="height" begin="0s" dur="1.4s" values="50;34;78;23;56;23;34;76;80;54;21;50" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="45" width="10" height="30" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s" values="30;45;13;80;56;72;45;76;34;23;67;30" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                </g>
                                </svg> 
                            </div>
                        </div>
                    </div>
                </div>
                    
                <div class="col-span-12 sm:col-span-4">
                    <div class="intro-y flex-1 px-5 py-16  sm:col-span-4 ">
                        <i data-feather="user-check" class="w-12 h-12 text-theme-9 mx-auto"></i> 
                        <div class="text-xl font-medium text-center mt-10 text-theme-9">Recovered</div>
                        <div class="flex justify-center">
                            <div class="relative text-5xl font-semibold mt-2 mx-auto" id="world-wide-recovered"> 
                                <svg width="15" viewBox="0 0 55 80" xmlns="http://www.w3.org/2000/svg" fill="rgb(45, 55, 72)" class="w-8 h-8">
                                <g transform="matrix(1 0 0 -1 0 80)">
                                    <rect width="10" height="20" rx="3">
                                        <animate attributeName="height" begin="0s" dur="4.3s" values="20;45;57;80;64;32;66;45;64;23;66;13;64;56;34;34;2;23;76;79;20" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="15" width="10" height="80" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s" values="80;55;33;5;75;23;73;33;12;14;60;80" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="30" width="10" height="50" rx="3">
                                        <animate attributeName="height" begin="0s" dur="1.4s" values="50;34;78;23;56;23;34;76;80;54;21;50" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="45" width="10" height="30" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s" values="30;45;13;80;56;72;45;76;34;23;67;30" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                </g>
                                </svg> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <div class="intro-y flex-1 px-5 py-16  sm:col-span-4 ">
                        <i data-feather="user-x" class="w-12 h-12 text-theme-6 mx-auto"></i> 
                        <div class="text-xl font-medium text-center mt-10 text-theme-6">Deaths</div>
                        <div class="flex justify-center">
                            <div class="relative text-5xl font-semibold mt-2 mx-auto" id="world-wide-deaths"> 
                                <svg width="15" viewBox="0 0 55 80" xmlns="http://www.w3.org/2000/svg" fill="rgb(45, 55, 72)" class="w-8 h-8">
                                <g transform="matrix(1 0 0 -1 0 80)">
                                    <rect width="10" height="20" rx="3">
                                        <animate attributeName="height" begin="0s" dur="4.3s" values="20;45;57;80;64;32;66;45;64;23;66;13;64;56;34;34;2;23;76;79;20" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="15" width="10" height="80" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s" values="80;55;33;5;75;23;73;33;12;14;60;80" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="30" width="10" height="50" rx="3">
                                        <animate attributeName="height" begin="0s" dur="1.4s" values="50;34;78;23;56;23;34;76;80;54;21;50" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="45" width="10" height="30" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s" values="30;45;13;80;56;72;45;76;34;23;67;30" calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                </g>
                                </svg> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Wizard Layout -->


<!-- END: Content -->
@push('page-scripts')
<script>
    $('.update-category').click((e) => {
        // Get the selected category button
        let selectedCategory = e.target;
        let category = $(selectedCategory).attr('data-target');
        let categoryElement = $(`#${category}`);
        // Hide the remaining elements.
        $('.update-category').each((i, e) => {
            // category buttons
            let id = $(e).attr('data-target');

            if(id !== category) {
                $(`#${id}`).addClass('hidden');
                $(e).removeClass('bg-theme-1')
                    .addClass('bg-gray-200')
                    .addClass('text-gray-600');
            } else {
                // Apply active color for button
                $(e).removeClass('text-gray-600')
                    .addClass('bg-theme-1')
                    .addClass('text-white');
                // Change the base title depending on the selected category    
                $('#base-title').text('')
                                .text(`COVID-19 Updates ${category.replace(/-/g, ' ')
                                                                  .toUpperCase()}`)
            }
            
        });

        // Display the selected category stats.
        categoryElement.removeClass('hidden');
    });
</script>
<script>
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    $(document).ready(function () {
        $.get('https://covid19stats.ph/api/stats/quick', {}, function (data, textStatus, jqXHR) {
            let cases = data.cases;
            let world = data.world;

            $('#philippines-confirmed').html(numberWithCommas(cases.total));
            $('#philippines-recovered').html(numberWithCommas(cases.recovered));
            $('#philippines-deaths').html(numberWithCommas(cases.deaths));


            $('#world-wide-confirmed').html(numberWithCommas(world.total));
            $('#world-wide-recovered').html(numberWithCommas(world.recovered));
            $('#world-wide-deaths').html(numberWithCommas(world.deaths));
        });

        $.get('https://covid19stats.ph/api/stats/location', {}, function (data, textStatus, jqXHR) {
            let surigaoDelSurCities = data.cities.filter((city) => city.slug.includes('surigao-del-sur'));
            let confirmedTotal = 0;
            let recoveredTotal = 0;
            let deathTotal = 0;

            surigaoDelSurCities.forEach((city, index) => {
                confirmedTotal += city.total;
                recoveredTotal += city.recovered;
                deathTotal += city.deaths;
            });


            $('#surigao-confirmed-case').html(numberWithCommas(confirmedTotal));
            $('#surigao-recovered').html(numberWithCommas(recoveredTotal));
            $('#surigao-deaths').html(numberWithCommas(deathTotal));
        });
    });
</script>


<script>
    var config = {
			type: 'pie',
			data: {
                labels : ["Normal", "Fever", "Severe"],
				datasets: [{
					data: [
					    100,
						200,
						300,
					],
                    backgroundColor: ["#2ecc71", "#f1c40f", "#e74c3c"],
                    hoverBackgroundColor: ["#2ecc71", "#f1c40f", "#e74c3c"],
                    borderWidth: 5,
                    borderColor: "#fff",
				}],
			},
			options: {
				responsive: true,
                legend : {
                    display : false,
                }
			}
		};

    var ctx = document.getElementById('test-chart').getContext('2d');
	testPie = new Chart(ctx, config);
</script>

@endpush
@endsection
