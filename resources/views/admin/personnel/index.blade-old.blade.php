@extends('admin.layouts.app')
@section('page-small-title','Personnel')
@section('page-title','Records')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.3/vendor/datatables/dataTables.bootstrap4.min.css">
@endprepend
@section('content')


<div class="card" >
    <div class="card-body">
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link " id="pills-records-tab" data-toggle="pill" href="#pills-records" role="tab" aria-controls="pills-records" aria-selected="true">Records</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-add-personnel-tab" data-toggle="pill" href="#pills-add-personnel" role="tab" aria-controls="pills-add-personnel" aria-selected="false">Add  Personnel</a>
        </li>
      </ul>

      <hr>

      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade  " id="pills-records" role="tabpanel" aria-labelledby="pills-records-tab">
            @include('admin.personnel.records')
        </div>
        <div class="tab-pane fade" id="pills-add-personnel" role="tabpanel" aria-labelledby="pills-add-personnel-tab">
            @include('admin.personnel.create')
        </div>
      </div>
    </div>
  </div>
  @push('page-scripts')
  <script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.3/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.3/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script>
    (function() {
      let previousSelectedTab = localStorage.getItem('selected_tab'); 
      
      // If no selected table dispaly default which is "Records"
      if(!previousSelectedTab) {
        previousSelectedTab = 'pills-records-tab';
      }

      // Active the tab.
      $(`#${previousSelectedTab}`).addClass('active');

      // Display the UI.
      $(`#${previousSelectedTab.replace('-tab', '')}`).addClass('active').addClass('show');

      // Check if the current tab is add record get all cities and barangays
      if(previousSelectedTab.includes('add-personnel')) {
        
        // Fetch cities.
        $.ajax({
          url : '/admin/cities', 
          success : (response) =>  {
            let citiesElement    = $('#cities');
            let OldCitiesValue = citiesElement.attr('data-old');

            
            // Push an empty child element for city by default
            citiesElement.append(`<option value disabled selected></option>`);
            // Push the cities data into select option form in admin/personnel/create.blade.php
              response.forEach((city) => citiesElement.append(`<option value="${city.zip_code}">${city.name}</option>`) );

              // user already select an option then validation failed.
              if(OldCitiesValue) {
                  citiesElement.val(OldCitiesValue).trigger('change');  
              }
          },
        });

        // If the cities element change fetch for barangays available to current selected city.
        $('#cities').change(function (e) {
          let cityId = e.target.value;
          let barangaysElement = $('#barangays');
          let oldBarangayValue = barangaysElement.attr('data-old');

          // Fetch all barangays
          $.ajax({
              url : `/admin/barangays/${cityId}`,
              success : (response) => {
                barangaysElement.empty();
                barangaysElement.removeAttr('readonly')

                response.forEach((barangay) => {
                    if(barangay.id === parseInt(oldBarangayValue)) {
                      barangaysElement.append(`<option selected value="${barangay.id}">${barangay.name}</option>`);  
                    } else {
                      barangaysElement.append(`<option value="${barangay.id}">${barangay.name}</option>`);  
                    }
                });
              },
          });
        });
      }

    })();
    $('#pills-tab a').on('click', function (e) {
      e.preventDefault()
      // selected tab 
      let tabId = $(this).attr('id');
      localStorage.setItem('selected_tab', tabId);
      $(this).tab('show')
    })
  </script>
  <script>
      $('#persons-table').DataTable({
            serverSide: true,
            ajax: "{{ route('persons.list') }}",
            columns: [
                { name: 'firstname' },
                { name: 'middlename' },
                { name: 'lastname' },
                { name: 'suffix' },
                { name: 'date_of_birth' },
                { name: 'rapid_test_issued' },
                // { name: 'role.name', orderable: false },
                // { name: 'action', orderable: false, searchable: false }
            ],
        });
  </script>
  @endpush
@endsection