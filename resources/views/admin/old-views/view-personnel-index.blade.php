@extends('admin.layouts.app')
@section('page-small-title','Personnel')
@section('page-title','View Personnel')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.3/vendor/datatables/dataTables.bootstrap4.min.css">
@endprepend
@section('content')
<div class="card" >
    <div class="card-body">
      <div class="row float-left col-lg-7">
        <div class="col-lg-7">
          <span>Filter by Province</span>
          <select name="cities" id="province_filter" class="form-control">
            <option value="all">Show All</option>
            @foreach($provinces as $province)
              <option value="{{ $province->code }}"> {{ $province->name }}</option>
            @endforeach
          </select>
        </div>


      </div>
      {{-- <div class="float-right">
        <a href="/admin/export/options" class="btn btn-primary">EXPORT</a>
      </div> --}}
      <div class="clearfix mb-2"></div>
      <table class="table table-bordered " id="persons-table" style="width:100%;">
        <thead>
          <tr>
            <td scope="col" class="font-weight-bold">ID</td>
            <td scope="col" class="font-weight-bold">Firstname</td>
            <td scope="col" class="font-weight-bold">Middlename</td>
            <td scope="col" class="font-weight-bold">Lastname</td>
            <td scope="col" class="font-weight-bold">Province</td>
            <td scope="col" class="font-weight-bold">City</td>
            <td scope="col" class="font-weight-bold">Barangay</td>
            <td scope="col" class="font-weight-bold">Registered Date</td>
            <td scope="col" class="font-weight-bold">Option</td>
          </tr>
        </thead>
        <tbody>
        </tbody>
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
    let QUERY_STRING = 'all';

    if(localStorage.getItem('FILTER_SELECT') == null) {
      QUERY_STRING = 'all';
    } else {
      QUERY_STRING = localStorage.getItem('FILTER_SELECT');
      $('#province_filter').val(QUERY_STRING);
    }

    let person_table =  $('#persons-table').DataTable({
            serverSide: true,
            ajax: `/admin/persons/list/${QUERY_STRING}`,
            columns: [
                { name: 'person_id' },
                { name: 'firstname' },
                { name: 'middlename' },
                { name: 'lastname' },
                { name: 'province.name' },
                { name: 'city.name' },
                { name: 'barangay.name' },
                { name: 'created_at' },
                { name: 'admin_action' , searchable : false, orderable : false, },
            ],
        });
  </script>

   <script>
      $('#province_filter').change(function (e) {
          QUERY_STRING = $(this).val();
          localStorage.setItem('FILTER_SELECT', QUERY_STRING);
          person_table.ajax.url(`/admin/persons/list/${QUERY_STRING}`).load();
      });
    </script>
  @endpush
@endsection
