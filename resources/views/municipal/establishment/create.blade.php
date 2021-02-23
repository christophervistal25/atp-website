
@extends('municipal.layouts.app')
@section('page-small-title','Personnel')
@section('page-title','Add New Establishment')
@section('content')

<section id="basic-alerts">
<form action="{{  route('m-establishment.store') }}" method="POST">
   @csrf
  <div class="row match-height">
            <div class="col-xl-12 col-lg-12">
                <div class="mb-2">
                    @if(Session::has('success'))
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">Successfully add new establishment.</div>
                    </div>
                    @endif
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Establishment Information</h4>
                        <a class="heading-elements-toggle">
                            <i class="la la-ellipsis-v font-medium-3"></i>
                        </a>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="office_store_name">Establishment/Office/Store Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control {{  $errors->has('office_store_name') ? 'is-invalid' : '' }}" id="office_store_name" name="office_store_name" placeholder="Enter Establishment/Office/Store Name" value="{{  old('office_store_name') }}">
                                @if($errors->has('office_store_name'))
                                    <small  class="form-text text-danger">
                                        {{ $errors->first('office_store_name') }} </small>
                                @endif
                            </div>

                                <div class="form-group mt-1">
                                    <label for="establishment_type">Establishment Type <span class="text-danger">*</span></label>
                                    {{  old('type') }}
                                    <select name="type" id="establishment_type" class="form-control {{ $errors->has('type')  ? 'is-invalid' : ''}}">
                                        @foreach($types as $type)
                                            <option {{ $type == old('type') ? 'selected' : ''  }} value="{{ $type }}"> {{ $type }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('type'))
                                    <small class="form-text text-danger">
                                        {{ $errors->first('type') }} </small>
                                    @endif
                                </div>
                            <div class="form-group mt-1">
                                <label for="address">Address<span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control" id="address" cols="30" rows="10">{{ old('address') }}</textarea>
                                @if($errors->has('address'))
                                <small class="form-text text-danger">
                                    {{ $errors->first('address') }} </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="contact_number">Contact Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control {{  $errors->has('contact_number') ? 'is-invalid' : '' }}" id="contact_number" name="contact_number" placeholder="Enter Contact Number" value="{{  old('contact_number') }}">
                                @if($errors->has('contact_number'))
                                <small class="form-text text-danger">
                                    {{ $errors->first('contact_number') }} </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="geo_tag_location">Geo Tag Location <span class="text-danger">*</span></label>
                                <input type="text" class="form-control {{  $errors->has('geo_tag_location') ? 'is-invalid' : '' }}" id="geo_tag_location" name="geo_tag_location" placeholder="Enter Geo Tag Location">
                                @if($errors->has('geo_tag_location'))
                                <small class="form-text text-danger">
                                    {{ $errors->first('geo_tag_location') }} </small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="barangay">Barangay <span class="text-danger">*</span></label>
                                <select name="barangay" id="barangay" class="form-control {{ $errors->has('barangay')  ? 'is-invalid' : ''}}">
                                    <option  selected disabled>Please Select Barangay</option>
                                    @foreach($barangays as $b)
                                        <option {{  $b->code == old('barangay') ? 'selected' : '' }} value="{{ $b->code }}"> {{ $b->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('barangay'))
                                <small class="form-text text-danger">
                                    {{ $errors->first('barangay') }} </small>
                                @endif
                            </div>
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary">Add New Establishment</button>

                                @if(Session::has('success'))
                                    <a href="" class="btn btn-success">Generate</a>
                                @endif
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-12"></div>
    </div>
    </form>
</section>
@push('page-scripts')
<script>
     function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(initPosition);
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        }

        function initPosition(position) {
            $('#geo_tag_location').val(`${position.coords.latitude}&${position.coords.longitude}`);
        }

        getLocation();
</script>
@endpush
@endsection
