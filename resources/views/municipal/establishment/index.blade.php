@extends('municipal.layouts.app')
@section('page-small-title','Personnel')
@section('page-title','View Establishment')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.3/vendor/datatables/dataTables.bootstrap4.min.css">
@endprepend
@section('content')
<div class="card" >
    <div class="card-body">
      <div class="row float-left col-lg-7">
        <div class="col-lg-7">
          {{-- <select name="cities" id="city_filter" class="form-control">
            <option value="all">Show All</option>
            @foreach($cities as $city)
              <option value="{{ $city->zip_code }}"> {{ $city->name }}</option>
            @endforeach
          </select> --}}
        </div>


      </div>
      <div class="clearfix mb-2"></div>
      <table class="table table-bordered " id="establishments-table" style="width:100%;">
        <thead>
            <tr>
              <td scope="col" class="text-center font-weight-bold">ID</td>
              <td scope="col" class="text-center font-weight-bold">Establishment/Office/Store Name</td>
              <td scope="col" class="text-center font-weight-bold">Address Located</td>
              <td scope="col" class="text-center font-weight-bold">Contact Number</td>
              <td scope="col" class="text-center font-weight-bold">Latitude</td>
              <td scope="col" class="text-center font-weight-bold">Longitude</td>
              <td scope="col" class="text-center font-weight-bold">Date/Time register</td>
              <td scope="col" class="text-center font-weight-bold">Option</td>
            </tr>
          </thead>
        <tbody class="text-center"></tbody>
      </table>
  </div>
</div>
  @push('page-scripts')
  <script>
    $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
  });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.3/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.3/vendor/datatables/dataTables.bootstrap4.min.js"></script>
   <script>
    $('#establishments-table').DataTable({
            serverSide: true,
            ajax: `{{ route('municipal.establishment.list') }}`,
            columns: [
                { name: 'id' },
                { name: 'name' },
                { name: 'address' },
                { name: 'contact_no' },
                { name: 'longitude' },
                { name: 'latitude' },
                { name: 'created_at' },
                { name: 'municipal_action' , searchable : false, orderable : false, },
            ],
        });
  </script>
  @endpush
@endsection
