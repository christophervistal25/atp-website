<div class="text-center">
    {{-- <button title="View logs of {{ $person->firstname }}" class="btn btn-sm btn-success btn-icon btn-edit-person" data-person-id="{{ $person->id }}"><i class="la la-check"></i></button> --}}
    <a href="{{ route('municipal.personnel.logs', $person->id) }}" target="_blank" title="View Generated QR Code" class=" text-sm btn btn-sm btn-info  btn-icon btn-info hide_btna" style="color:white;"> <i class="la la-history"></i></a>

<a class="btn btn-success btn-icon btn-sm" href="{{ route('municipal.print.qr', $person->id) }}" target="_blank"><i class="la la-print"></i></a>
</div>
