@extends('admin.layouts.app')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.3/vendor/datatables/dataTables.bootstrap4.min.css">
@endprepend
@section('page-small-title','Personnel')
@section('page-title',  $person->firstname . ' ' . $person->middlename[0] . '. ' . $person->lastname . ' Logs')
@section('content')
<section id="basic-alerts">
  <div class="row match-height">
      <div class="col-xl-5 col-lg-12">
        @include('templates.success')
          <form action="{{ route('personnel.logs.update', $person->id) }}" method="POST">
            @csrf
            @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">  <img src="{{ asset('/storage/images/' . $person->image) }}" width="10%"> Personnel Information</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="rapid_pass_no">Rapid Pass No. <span class="text-danger">*</span></label>
                                <input type="text" class="form-control {{ $errors->has('rapid_pass_no') ? 'is-invalid' : '' }} " id="rapid_pass_no" name="rapid_pass_no" placeholder="Rapid Pass No" value="{{ old('rapid_pass_no') ?? $person->rapid_pass_no }}" >
                                @if($errors->has('rapid_pass_no'))
                                    <small  class="form-text text-danger">
                                        {{ $errors->first('rapid_pass_no') }} </small>
                                @endif
                            </div>


                            <div class="form-group mt-1">
                            <label for="firstname">Firstname <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('firstname') ? 'is-invalid' : '' }}" id="firstname" name="firstname" placeholder="Enter Firstname" value="{{ old('firstname') ?? $person->firstname }}" >
                            @if($errors->has('firstname'))
                                <small  class="form-text text-danger">
                                {{ $errors->first('firstname') }} </small>
                            @endif
                            </div>

                            <div class="form-group">
                                <label for="middlename">Middlename <span class="text-danger">*</span></label>
                                <input type="text" class="form-control {{ $errors->has('middlename') ? 'is-invalid' : '' }} " id="middlename" name="middlename" placeholder="Enter Middlename" value="{{ old('middlename') ?? $person->middlename }}" >
                                @if($errors->has('middlename'))
                                    <small  class="form-text text-danger">
                                    {{ $errors->first('middlename') }} </small>
                                @endif

                            </div>

                            <div class="form-group">
                                <label for="lastname">Lastname <span class="text-danger">*</span></label>
                                <input type="text" class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}" id="lastname" name="lastname" placeholder="Enter Lastname" value="{{ old('lastname') ?? $person->lastname }}" >
                                @if($errors->has('lastname'))
                                    <small  class="form-text text-danger">
                                {{ $errors->first('lastname') }} </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="suffix">Suffix </label>
                                <input type="text" class="form-control" id="suffix" name="suffix" placeholder="e.g Jr." value="{{ old('suffix') ??  $person->suffix }}" >
                            </div>



                            {{-- <hr> --}}

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="date_of_birth">Date of birth <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') ?? $person->date_of_birth }}" >
                                        @if($errors->has('date_of_birth'))
                                            <small  class="form-text text-danger">
                                            {{ $errors->first('date_of_birth') }} </small>
                                        @endif
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="rapid_test_issued">Rapid test issued <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control {{ $errors->has('rapid_test_issued') ? 'is-invalid' : '' }}" id="rapid_test_issued" name="rapid_test_issued"  value="{{ old('rapid_test_issued') ?? $person->rapid_test_issued }}" >
                                        @if($errors->has('rapid_test_issued'))
                                            <small  class="form-text text-danger">
                                            {{ $errors->first('rapid_test_issued') }} </small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address">Address <span class="text-danger">*</span></label>
                                <textarea name="address" id="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" rows="3" >{{ $person->address }}</textarea>
                                @if($errors->has('address'))
                                    <small  class="form-text text-danger">
                                    {{ $errors->first('address') }} </small>
                                @endif
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="city">City <span class="text-danger">*</span></label>
                                        <select id="cities" name="city" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}">
                                            @foreach($cities as $city)
                                                @if(!is_null(old('city')))
                                                    <option {{ old('city') === $city->zip_code ? 'selected' : '' }} value="{{ $city->zip_code }}">{{ $city->name }}</option>
                                                @else
                                                    <option {{ $person->city_zip_code === $city->zip_code ? 'selected' : '' }} value="{{ $city->zip_code }}">{{ $city->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if($errors->has('city'))
                                            <small  class="form-text text-danger">
                                            {{ $errors->first('city') }} </small>
                                        @endif
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="barangay">Barangay <span class="text-danger">*</span></label>
                                        <select name="barangay"  id="barangay" class="form-control {{ $errors->has('barangay') ? 'is-invalid' : '' }}">
                                            @foreach($barangays as $barangay)
                                            @if(!is_null(old('barangay')))
                                                <option data-zip-code="{{ $barangay->city_zip_code }}" {{ old('barangay') === $barangay->id ? 'selected' : '' }} value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                                            @else
                                                <option data-zip-code="{{ $barangay->city_zip_code }}" {{ $person->barangay_id === $barangay->id ? 'selected' : '' }} value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @if($errors->has('barangay'))
                                            <small  class="form-text text-danger">
                                            {{ $errors->first('barangay') }} </small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gender">Sex <span class="text-danger">*</span></label>
                                <select name="gender" class="form-control">
                                    @foreach(['male', 'female'] as $gender)
                                        <option value="{{ $gender }}">{{ ucfirst($gender) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="submit" class="btn btn-success btn-block" value="UPDATE">

                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="col-xl-7 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Personnel Logs</h4>
                        <a class="heading-elements-toggle">
                            <i class="la la-ellipsis-v font-medium-3"></i>
                        </a>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <table class="table table-bordered" id="logs-table">
                                <thead>
                                    <tr>
                                        <th>Location</th>
                                        <th>Temperature</th>
                                        <th>Checker</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($person->logs as $log)
                                    <tr>
                                        <td class="text-center">{{ $log->location }}</td>
                                        <td class="text-center">{{ $log->body_temperature }}</td>
                                        <td class="text-center text-capitalize">{{ $log->checker->lastname }}, {{ $log->checker->firstname }} {{ $log->checker->middlename }}</td>
                                        <td class="text-center">{{ $log->time }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.3/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.3/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function () {
        $('#logs-table').DataTable();
    });
</script>
@push('page-scripts')
<script>
    $(document).ready(function () {
        let barangayOptionAll = [];
        $('#cities').change(function (e) {

            let cityZipCode = e.target.value;



            if(barangayOptionAll.length === 0) {
                barangayOptionAll = $('#barangay option');
            }


            barangayOptionAll.filter((index, barangayOption) => {

                if(barangayOption.getAttribute('data-zip-code') == cityZipCode) {
                    $('#barangay').append(barangayOption);
                } else {
                    $('#barangay').val($(barangayOption).remove());
                }
            });

        });
    });
</script>
@endpush
@endpush
@endsection
