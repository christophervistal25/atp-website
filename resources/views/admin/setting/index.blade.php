@extends('templates-2.app')
@section('page-title','List of Defaults')
@prepend('page-css')
@endprepend
@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
  <h2 class="text-lg font-medium mr-auto">
      {{-- List of Defaults --}}
  </h2>
</div>
<div class="intro-y box p-5 mt-5">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Users Layout -->
        @forelse($settings as $setting)
            <div class="intro-y col-span-12 md:col-span-6">
                <div class="box">
                    <div class="flex flex-col lg:flex-row items-center p-5 border-b border-gray-200">
                        <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                            <a class="font-medium capitalize">{{ str_replace('_', ' ', $setting->name) }}</a>
                            <div class="text-gray-600 text-xs">{{ str_repeat('●', 20) }}</div>
                        </div>
                    </div>
                    <div class="flex flex-wrap lg:flex-no-wrap items-center justify-center p-5">
                        <div class="w-full lg:w-1/2 mb-4 lg:mb-0 mr-auto">
                            <div class="flex">
                                <div class="text-gray-600 text-xs mr-auto capitalize">Change {{ str_replace('_', ' ', $setting->name) }} Value</div>

                            </div>
                            <div class="w-full mt-2 rounded-full">
                                <input type="text" class="input w-full border input--sm" placeholder="Enter new value" name="{{ $setting->name }}">
                            </div>
                        </div>
                        <button class="button button--sm text-white bg-theme-1 mt-5" type="submit">Change</button>
                    </div>
                </div>
            </div>
            @empty
            @endforelse

        <!-- END: Users Layout -->
    </div>
</div>
@endsection
