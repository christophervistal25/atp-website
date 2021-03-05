@extends('user.templates.app')
@section('page-title', 'Dashboard')
@prepend('page-css')
@include('templates.select-option')
@endprepend
@section('content')
<div class="grid grid-cols-12 gap-6">
  <div class="col-span-12 xxl:col-span-12 grid grid-cols-12 gap-6">
      <!-- BEGIN: Update your profile -->
      <div class="col-span-12 mt-8">
          {{-- @include('templates.error') --}}
          <div class="intro-y flex items-center h-10">
              <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
          </div>
          <div class="grid grid-cols mt-5">
              <div class="intro-y col-span-12 lg:col-span-6">
                      <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6">
                          <i data-feather="alert-circle" class="w-6 h-6 mr-2 text-white"></i>
                          <ul class="font-medium text-white">
                            <li>• Please fill out this form as honestly and accurately as possible</li>
                            <li>• All fields with * mark are required.</li>
                          </ul>
                      </div>
                  <!-- BEGIN: Input -->
                  <div class="intro-y box">
                      <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                          <h2 class="font-medium text-base mr-auto">
                              Your Information
                          </h2>
                      </div>
                      <div class="p-5" id="input">
                          <form method="POST" enctype="multipart/form-data" action="{{ route('user.update.profile.submit') }}" class="preview">
                              @csrf
                              @method('PUT')
                              <div class="mb-2 flex-1 flex flex-col md:flex-row">
                                  <div class="w-full flex-1 mx-2">
                                      <label>
                                          Province
                                          <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                      </label>
                                      <div class=" p-1 bg-white flex">
                                          <select value="{{  old('province') }}" class="input select2 select-province border {{ $errors->has('date_of_birth')  ? 'border-red-500' : '' }} p-2 px-2 appearance-none outline-none w-full text-gray-800" name="province" id="province">
                                              @foreach($provinces as $province)
                                                  <option {{ old('province') == $province->code ? 'selected' : '' }} value="{{ $province->code }}"> {{ $province->name }}</option>
                                              @endforeach
                                          </select>
                                      </div>

                                  </div>
                                  <div class="w-full flex-1 mx-2 ">
                                      <label for="">
                                          City
                                          <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                      </label>
                                      <div class=" bg-white flex {{  $errors->has('city') ? 'border border-red-500 rounded' : '' }}">
                                          <select class="select2 select-city input border p-2 px-2 appearance-none outline-none w-full text-gray-800"  name="city" id="cities">
                                              <option selected disable>Select City</option>
                                          </select>
                                      </div>
                                      @if($errors->has('city'))
                                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                            {{  $errors->first('city') }}
                                        </span>
                                      @endif
                                  </div>

                                  <div class="w-full flex-1 mx-2">
                                      <label for="">
                                          Barangay
                                          <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                      </label>
                                      <div class="bg-white {{  $errors->has('barangay') ? 'border rounded border-red-500' : '' }}">
                                          <select class="select2 input border p-2 px-2 appearance-none outline-none w-full text-gray-800" name="barangay" id="barangay">
                                              <option selected disable>Select Barangay</option>
                                          </select>
                                      </div>
                                      @if($errors->has('barangay'))
                                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                            {{  $errors->first('barangay') }}
                                        </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="w-full flex-1 mx-2">
                                  <label for="">
                                      Temporary Address
                                      <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                  </label>
                                  <div class="p-1 bg-white flex border {{  $errors->has('temporary_address') ? 'border-red-500' : '' }} rounded rounded">
                                      <textarea placeholder="e.g. Purok Paradise 950" class="p-1 px-2 appearance-none outline-none w-full text-gray-800" rows="5" name="temporary_address">{{  old('temporary_address') }}</textarea>
                                  </div>
                                  <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                      Required, atleast 5 characters
                                  </span>
                                  <div class="mb-2"></div>
                              </div>

                              <div class="w-full flex-1 mx-2">

                                  <label for="">
                                      Permanent Address
                                      <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                  </label>
                                  <div class="p-1 bg-white flex border {{  $errors->has('address') ? 'border-red-500' : '' }} rounded">
                                      <textarea placeholder="e.g. Purok Paradise 950"  class="p-1 px-2 appearance-none outline-none w-full text-gray-800" rows="5" name="address">{{ old('address') }}</textarea>
                                  </div>
                                  <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                      Required, atleast 5 characters
                                  </span>
                                  <div class="mb-2"></div>
                              </div>


                              <div class="mb-2 flex-1 flex flex-col md:flex-row">
                                <div class="w-full flex-1 mx-2">
                                    <label>MPIN
                                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                            *
                                        </span>
                                    </label>
                                    <div class=" p-1 bg-white flex">
                                        <input
                                            type="password"
                                            class="input w-full border px-2 p-2 appearance-none outline-none {{  $errors->has('mpin') ? 'border-red-500' : '' }}"
                                            name="mpin"
                                            maxlength="4"
                                            placeholder="Enter your MPIN"
                                            value="{{ old('mpin') }}">
                                    </div>
                                    @if($errors->has('mpin'))
                                    <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600 capitalize">
                                        {{  $errors->first('mpin') }}
                                    </span>
                                    @else
                                    <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                        Maximum of 4 digits
                                    </span>
                                    @endif

                                </div>
                                <div class="w-full flex-1 mx-2">
                                    <label>Re-type MPIN
                                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                            *
                                        </span>
                                    </label>
                                    <div class=" p-1 bg-white flex">
                                        <input
                                            type="password"
                                            class="input w-full border px-2 p-2 appearance-none outline-none {{  $errors->has('mpin') ? 'border-red-500' : '' }}"
                                            name="confirm_mpin"
                                            placeholder="Re-type your MPIN"
                                            maxlength="4"
                                            value="{{ old('confirm_mpin') }}">
                                    </div>

                                    <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600 capitalize">
                                        {{ $errors->first('mpin') }}
                                    </span>
                                </div>
                            </div>

                              <div class="mb-2 flex-1 flex flex-col md:flex-row">
                                  <div class="w-full flex-1 mx-2">
                                      <label>  Sex
                                          <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                              *
                                          </span>
                                      </label>
                                      <div class=" p-1 bg-white flex">
                                          <select class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800  border {{  $errors->has('gender') ? 'border-red-500' : '' }}" name="gender"
                                              value="{{ old('gender') }}">
                                                  <option value="Male">Male</option>
                                                  <option value="Female">Female</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="w-full flex-1 mx-2">
                                      <label>
                                          Status
                                          <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                              *
                                          </span>
                                      </label>
                                      <div class="p-1 bg-white flex ">
                                          <select class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 border {{  $errors->has('status') ? 'border-red-500' : '' }}" name="status" value="{{ old('status') }}">
                                              @foreach($civil_status as $status)
                                              <option value={{ $status }}>{{ $status }}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
                              </div>

                              <div class="mb-2 flex-1 flex flex-col md:flex-row">
                                  <div class="w-full flex-1 mx-2">
                                      Email
                                      <div class=" p-1 bg-white flex">
                                          <input class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800" type="email" placeholder="e.g. user@gmail.com" name="email">
                                      </div>
                                  </div>
                                  <div class="w-full flex-1 mx-2">
                                      Landline Number
                                      <div class="p-1 bg-white">
                                          <input class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800" type="text" placeholder="e.g. 8123-4567" name="landline_number">
                                      </div>
                                  </div>
                              </div>


                              <div class="w-full flex-1 mx-2">
                                  <label>
                                      Image
                                      <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                          *
                                      </span>
                                  </label>

                                  <div class="p-1 bg-white flex  rounded">
                                      <input class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 border {{  $errors->has('image') ? 'border-red-500' : '' }}"" type="file" name="image">
                                  </div>
                                  <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                      Required, attach only image file
                                  </span>
                              </div>

                              <div class="flex lg:justify-end">
                                  <button type="submit" class="button bg-theme-1 text-white w-auto">Update your profile</button>
                              </div>

                          </form>

                          </div>
                      </div>
                  </div>
                  <!-- END: Input -->
              </div>
          </div>
      </div>
      <!-- END: Update your profile -->
  </div>
</div>
@push('page-scripts')
<script>
    $(document).ready(() => {
        const BASE_URL = '/api/province';

        // // Load all provinces using ajax.
        // $.get(`/api/provinces`, (provinces) =>  {
        //   provinces.forEach((province) => {
        //     $('.select-province').append(`<option value="${province.code}">${province.name}</option>`);
        //   })
        // });


        // User Select Province then populate all data for province.
        $('#province').change((e) => {
            let provinceCode = e.target.value;
            let elementCities = $('.select-city');
            // Make an AJAX request to get all city filtered by selected province.
            $.ajax({
                url : `${BASE_URL}/municipal/${provinceCode}`,
                success : (response) => {
                    // Clear all option of cities select element
                    elementCities.find('option').remove();

                    // Iterate to all city by province code and display to select
                    response.municipals.forEach((municipal) => {
                        elementCities.append(`<option value="${municipal.code}">${municipal.name}</option>`);
                    });

                }

            });
        });


        // User Select City then populate all data for barangays
        $('#cities').change((e) =>  {
            let selectedCityCode = e.target.value;
            let barangayElement = $('#barangay');

            // Make an AJAX request to get all barangay filtered by selected city.
            $.ajax({
                url : `${BASE_URL}/barangay/${selectedCityCode}`,
                success : (response) =>  {
                    // Clear all option of barangay select element
                    barangayElement.find('option').remove();

                    // Iterate to all barangay by city code and display to select
                    response.barangays.forEach((barangay) =>  {
                        $('#barangay').append(`<option value="${barangay.code}">${barangay.name}</option>`);
                    });

                }
            });

        });
    });
</script>
@endpush
@endsection
