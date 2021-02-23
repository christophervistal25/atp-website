@extends('municipal.layouts.app')
@section('page-small-title','Personnel')
@section('page-title','View Checkers')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.3/vendor/datatables/dataTables.bootstrap4.min.css">
@endprepend
@section('content')
<div class="card" >
    <div class="card-body">
      <div class="float-right">
        <a href="{{ route('m-checker.create') }}" class="btn btn-primary">ADD NEW CHECKER</a>
      </div>
      <div class="clearfix mb-2"></div>
      <table class="table table-bordered " id="checkers-table" style="width:100%;">
        <thead>
          <tr>
            <td scope="col" class="font-weight-bold">Username</td>
            <td scope="col" class="font-weight-bold">Firstname</td>
            <td scope="col" class="font-weight-bold">Middlename</td>
            <td scope="col" class="font-weight-bold">Lastname</td>
            <td scope="col" class="font-weight-bold">Suffix</td>
            <td scope="col" class="font-weight-bold">Municipal</td>
            <td scope="col" class="font-weight-bold">Registered Date</td>
            <td scope="col" class="font-weight-bold">Option</td>
          </tr>
        </thead>
        <tbody>
          @foreach($checkers as $checker)
            <tr>
              <td class="text-center">{{ $checker->username }}</td>
              <td class="text-capitalize">{{ $checker->firstname }}</td>
              <td class="text-capitalize">{{ $checker->middlename }}</td>
              <td class="text-capitalize">{{ $checker->lastname }}</td>
              <td class="text-capitalize">{{ $checker->suffix }}</td>
              <td class="text-capitalize">{{ $checker->city->name }}</td>
              <td class="text-capitalize text-center">{{ $checker->created_at->format('m/d/Y') }}</td>
              <td class="text-center">
                <a class="btn btn-icon btn-sm btn-success text-white" href="{{ route('m-checker.edit', $checker->id) }} ">
                <i class="la la-edit"></i>
              </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
  </div>
</div>
  @push('page-scripts')
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.3/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.3/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script>
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
    $('#checkers-table').DataTable();
  </script>


  @endpush
@endsection
