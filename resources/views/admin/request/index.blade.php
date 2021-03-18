@extends('templates-2.app')
@section('page-title','List of Update Request')
@prepend('page-css')
@endprepend
@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        @yield('page-title')
    </h2>
</div>
<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
    <table class="table display datatable w-full">
        <thead>
            <tr>
                <td class="font-medium">Personnel</td>
                <td class="font-medium text-center">Status</td>
                <td class="font-medium text-center">Requested By</td>
                <td class="font-medium text-center">Requested At</td>
                <td class="font-medium text-center">Options</td>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
            <tr>
                <td>
                    {{ $request->person ? $request->person->lastname : '' }}
                    {{ $request->person ? $request->person->firstname : '' }}
                    {{ $request->person ? $request->person->middlename : '' }}
                    {{ $request->person ? $request->person->suffix : '' }}
                </td>
                <td class="text-center">
                    <span
                        class="bg-theme-1 font-medium rounded text-center text-xs text-white p-1 capitalize">{{ $request->status }}</span>
                </td>
                <td class="text-center">
                    {{ $request->from }}
                </td>
                <td class="text-center">{{ $request->created_at->format(' F d, Y h:i A') }}</td>
                <td>
                    <div class="flex sm:justify-center items-center">
                        <a class="flex items-center mr-3 rounded-full p-3 bg-white shadow"
                            href="#" title="Approved">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-map-pin mx-auto">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
<!-- END: Datatable -->
@endsection
