@extends('admin.layouts.app')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.3/vendor/datatables/dataTables.bootstrap4.min.css">
@endprepend
@section('page-small-title','Personnel')
@section('page-title',  $person->firstname . ' ' . $person->middlename[0] . '. ' . $person->lastname . ' ' . $person->suffix . ' Logs')
@section('content')
<section id="basic-alerts">
  <div class="row match-height">
      <div class="col-xl-12 col-lg-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active text-white" id="information-tab" data-toggle="tab" href="#information" role="tab" aria-controls="information" aria-selected="true">Information</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">History</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="information-tab">
                <div class="col-xl-12 col-lg-12 mt-2">
                @include('templates.success')
                <form action="{{ route('personnel.logs.update', $person->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Personnel Information</h4>
                            <a class="heading-elements-toggle">
                                <i class="la la-ellipsis-v font-medium-3"></i>
                            </a>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="row">
                                        <div class="form-group  col-lg-3">
                                            <label for="firstname">Firstname <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control {{ $errors->has('firstname')  ? 'is-invalid' : ''}}" id="firstname" name="firstname" placeholder="Enter Firstname" value="{{ old('firstname') ?? $person->firstname }}">
                                            @if($errors->has('firstname'))
                                                <small  class="form-text text-danger">
                                                    {{ $errors->first('firstname') }} </small>
                                            @endif
                                        </div>
    
                                        <div class="form-group col-lg-3 ">
                                                <label for="middlename">Middlename <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control {{ $errors->has('middlename')  ? 'is-invalid' : ''}} " id="middlename" name="middlename" placeholder="Enter Middlename" value="{{ old('middlename') ?? $person->middlename }}">
                                                @if($errors->has('middlename'))
                                                <small  class="form-text text-danger">{{ $errors->first('middlename') }} </small>
                                                @endif
                                        </div>
    
                                        <div class="form-group col-lg-3">
                                            <label for="lastname">Lastname <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control {{ $errors->has('lastname')  ? 'is-invalid' : ''}}" id="lastname" name="lastname" placeholder="Enter Lastname" value="{{ old('lastname') ?? $person->lastname }}">
    
                                            @if($errors->has('lastname'))
                                                <small  class="form-text text-danger">
                                                {{ $errors->first('lastname') }} </small>
                                            @endif
                                        </div>
    
                                        <div class="form-group col-lg-3">
                                            <label for="suffix">Suffix </label>
                                            <input type="text" class="form-control {{ $errors->has('suffix')  ? 'is-invalid' : ''}}" id="suffix" name="suffix" placeholder="e.g Jr." value="{{ old('suffix') ?? $person->suffix }}">
                                            @if($errors->has('suffix'))
                                                <small  class="form-text text-danger">
                                                {{ $errors->first('suffix') }} </small>
                                            @endif
                                        </div>
                                </div>
    
    
    
    
                                {{-- <hr> --}}
    
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="date_of_birth">Date of birth <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control  {{ $errors->has('date_of_birth')  ? 'is-invalid' : ''}}" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') ?? $person->date_of_birth }}">
                                            @if($errors->has('date_of_birth'))
                                                <small  class="form-text text-danger">
                                                {{ $errors->first('date_of_birth') }} </small>
                                            @endif
                                        </div>
    
    
                                    </div>
                                </div>
    
                                
    
    
    
                                <div class="form-group">
                                        <label for="province">Province<span class="text-danger">*</span></label>
                                        <select name="province" id="province" class="form-control {{ $errors->has('province')  ? 'is-invalid' : ''}}">
                                            @foreach($provinces as $province)
                                                    @if(old('province'))
                                                        <option {{ old('province') == $province->code ? 'selected' : '' }} value="{{ $province->code }}"> {{ $province->name }}</option>
                                                    @else
                                                        <option {{ $person->province_code == $province->code ? 'selected' : '' }} value="{{ $province->code }}"> {{ $province->name }}</option>
                                                    @endif
                                            @endforeach
                                        </select>
                                        @if($errors->has('province'))
                                            <small  class="form-text text-danger">
                                            {{ $errors->first('province') }} </small>
                                        @endif
                                 </div>
    
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="city">City <span class="text-danger">*</span></label>
                                            <select name="city" id="cities" class="form-control {{ $errors->has('city')  ? 'is-invalid' : ''}}">
                                                <option value="" disabled>Select province</option>
                                                @foreach($cities as $city)
                                                    @if(old('city'))
                                                        <option {{ old('city') == $city->code ? 'selected' : '' }} value="{{ $city->code }}"> {{ $city->name }}</option>
                                                    @else
                                                        <option {{ $person->city_code == $city->code ? 'selected' : '' }}  value="{{ $city->code }}"> {{ $city->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if($errors->has('city'))
                                            <small  class="form-text text-danger">
                                            {{ $errors->first('city') }} </small>
                                            @endif
                                        </div>
    
                                        <div class="col-lg-6">
                                            <label for="barangay">Barangay<span class="text-danger">*</span></label>
                                            <select name="barangay" id="barangay" class="form-control {{ $errors->has('barangay')  ? 'is-invalid' : ''}}">
                                                <option value="" disabled>Select City</option>
                                                @foreach($barangays as $barangay)
                                                @if(old('barangay'))
                                                    <option {{ old('barangay') == $barangay->code ? 'selected' : '' }}  value="{{ $barangay->code }}"> {{ $barangay->name }}</option>
                                                @else
                                                    <option {{ $person->barangay_code == $barangay->code ? 'selected' : '' }}   value="{{ $barangay->code }}"> {{ $barangay->name }}</option>
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
                                        <label for="temporary_address">Temporary Address <span class="text-danger">*</span></label>
                                         <textarea name="temporary_address" id="temporary_address" class="form-control">{{  old('temporary_address') ?? $person->temporary_address }}</textarea>
                                    @if($errors->has('temporary_address'))
                                         <small  class="form-text text-danger">
                                         {{ $errors->first('temporary_address') }} </small>
                                     @endif
                                </div>

                                <div class="form-group">
                                    <label for="address">Address <span class="text-danger">*</span></label>
                                    <textarea name="address" id="address" class="form-control {{ $errors->has('address')  ? 'is-invalid' : ''}}" rows="3">{{ old('address') ?? $person->address }}</textarea>
                                    @if($errors->has('address'))
                                        <small  class="form-text text-danger">
                                        {{ $errors->first('address') }} </small>
                                    @endif
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="gender">Sex <span class="text-danger">*</span></label>
                                            <select name="gender" id="gender" class="form-control {{ $errors->has('gender')  ? 'is-invalid' : ''}}">
                                                @if(old('gender'))
                                                <option {{ old('gender') == 'male' ? 'selected' : '' }} value="male">Male</option>
                                                <option {{ old('gender') == 'female' ? 'selected' : '' }} value="female">Female</option>
                                                    @else
                                                    <option {{ $person->gender == 'male' ? 'selected' : '' }} value="male">Male</option>
                                                    <option {{ $person->gender == 'female' ? 'selected' : '' }} value="female">Female</option>
                                                @endif
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                                <select name="civil_status" id="status" class="form-control {{ $errors->has('civil_status')  ? 'is-invalid' : ''}}">
                                                    @foreach($civil_status as $status)
                                                        @if(old('civil_status'))
                                                            <option {{ old('civil_status') == $status ? 'selected' : '' }} value="{{ $status }}">{{ $status }}</option>
                                                        @else
                                                        <option {{  $person->civil_status == $status ? 'selected' : '' }} value="{{ $status }}">{{ $status }}</option>
                                                        @endif
                                                        
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">{{ $errors->first('civil_status') }}</div>
                                    </div>
                                    </div>
                                </div>
                                
    
                                
                                
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control {{ $errors->has('email')  ? 'is-invalid' : ''}}" id="email" name="email" placeholder="Optional" value="{{ old('email')  ?? $person->email }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="phone_number">Cellphone Number <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control {{ $errors->has('phone_number')  ? 'is-invalid' : ''}}" id="phone_number" name="phone_number" placeholder="" value="{{ old('phone_number') ?? $person->phone_number }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="landline_number">Landline Number <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control {{ $errors->has('landline_number')  ? 'is-invalid' : ''}}" id="landline_number" name="landline_number" placeholder="" value="{{ old('landline_number') ?? $person->landline_number }}">
                                        </div>
                                    </div>
                                </div>
                                
    
                                
    
                                {{-- <div class="form-group">
                                    <label for="">Image <span class="text-warning">(Optional attach only if want to modify)</span></label>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input {{ $errors->has('image')  ? 'is-invalid' : ''}}" id="imageFile" >
                                        <label class="custom-file-label" for="imageFile">Choose file...</label>
                                        <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                    </div>
                                </div>
     --}}
                                <div class="float-right">
                                    <button type="submit" class="btn btn-success">Update Personnel Information</button>
                                </div>
    
                                <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            </div>
            <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                <div class="card mt-2">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <table class="table table-bordered" id="logs-table">
                                <thead>
                                    <tr>
                                        <th>Location</th>
                                        <th>Temperature</th>
                                        <th>Checker</th>
                                        <th>Purpose</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($person->logs as $log)
                                    <tr>
                                        <td class="text-center">{{ $log->location }}</td>
                                        <td class="text-center">{{ $log->body_temperature }}</td>
                                        <td class="text-center text-capitalize">{{ $log->checker->lastname }}, {{ $log->checker->firstname }} {{ $log->checker->middlename }}</td>
                                        <td>{{  $log->purpose }}</td>
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
        $('#province').change(function (e) {
            $.ajax({
                url : `/api/province/municipal/${e.target.value}`,
                success : function (response) {
                    // Clear all option of cities select element
                    $('#cities').find('option').remove();
                    response.municipals.forEach((municipal) => $('#cities').append(`<option value="${municipal.code}">${municipal.name}</option>`));
                },
            });
        });

        $('#cities').change(function (e) {
            $.ajax({
                url : `/api/province/barangay/${e.target.value}`,
                success : function (response) {
                    // Clear all option of barangay select element
                    $('#barangay').find('option').remove();
                    response.barangays.forEach((barangay) => $('#barangay').append(`<option value="${barangay.code}">${barangay.name}</option>`));
                },
            });
        });
    });
</script>
@endpush
@endpush
@endsection
