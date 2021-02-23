@extends('municipal.layouts.app')
@section('page-small-title','Personnel')
@section('page-title','View Personnel')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.3/vendor/datatables/dataTables.bootstrap4.min.css">
@endprepend
@section('content')
<div class="card" >
    <div class="card-body">
      <div class="float-right">
        <!--<a href="/municipal/export/options" class="btn btn-primary">EXPORT</a>-->
      </div>
      <div class="clearfix mb-2"></div>
      <table class="table table-bordered" id="persons-table">
        <thead>
          <tr>
            <td scope="col" class="font-weight-bold text-center">ID</td>
            <td scope="col" class="font-weight-bold">Firstname</td>
            <td scope="col" class="font-weight-bold">Middlename</td>
            <td scope="col" class="font-weight-bold">Lastname</td>
            <td scope="col" class="font-weight-bold">Barangay</td>
            <td scope="col" class="font-weight-bold">Registered At</td>
            <td scope="col" class="font-weight-bold">Option</td>
          </tr>
        </thead>
        <tbody class="text-center"><tbody>
      </table>
  </div>
</div>
  @push('page-scripts')
  <script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.3/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.3/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script>

    let person_table =  $('#persons-table').DataTable({
            serverSide: true,
            ajax: "{{ route('municipal-people-list') }}",
            columns: [
                { name: 'person_id' },
                { name: 'firstname' },
                { name: 'middlename' },
                { name: 'lastname' },
                { name: 'barangay.name', orderable : false },
                { name: 'created_at' , orderable : false },
                { name: 'action' , searchable : false, orderable : false },
            ],
        });
  </script>
  @endpush
@endsection
