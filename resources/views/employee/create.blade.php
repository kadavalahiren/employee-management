@extends('layouts.new.master')
@section('title')
    Add Employee
@endsection
@section('links')
    <!-- DatePicker CSS Starts-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{ asset('/custome/css/daterangepicker.css')}}" />
    <link href="{{ asset('/custome/css/common.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="title breadcrumbSpacing">
            <div class="sub-title">
                <h3 class="me-auto">Employee</h3>
                <a href="{{ url('/employee') }}">Employee</a>
                <span><i class="fa-solid fa-circle fa-xs"></i></span>
                <a>Add</a>
            </div>
        </div>

        <!-- Main Code Starts Here -->
        @if(empty($employee))
        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        @else
        <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @endif
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card-body bg-white p-3 rounded">
                        <h5><span class="card-header mb-3 comman_cm_title">Image</span>
                            <span class="required"> *</span>
                        </h5>
                        <div class="gap-4" style="text-align: -webkit-center;">
                            <div class="uploader-img ">
                                @if (isset($employee->profile_image_url) != null && isset($employee->profile_image_url) != '')
                                    <img id="offer_image_perview"
                                        src="{{ asset( $employee->profile_image_url ) }}" height="100px"
                                        width="100px">
                                @else
                                    <img id="offer_image_perview"
                                        src="{{-- url($MAIN_URL . 'admin/newTheme/assets/img/avatars/17.png') --}}"
                                        height="100px" width="100px">
                                @endif
                            </div>
                            <div class="button-wrapper">
                                <label for="upload" class="btn upload_btn btn-primary" tabindex="0">
                                    <span class="d-none d-sm-block">Browse</span>
                                    <i class="ti ti-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" name="upload" class="account-file-input"
                                        onchange="loadFile(event)" hidden accept="image/png, image/jpeg" />

                                </label>
                                <div class="text-muted">Upload photo size 640px*480px<br>
                                    *.PNG, *.JPG & *.JPEG File
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div><!-- /col-md-4 -->
                <div class="col-md-12">
                    <div class="card">
                        <!-- Account -->
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <h6>First Name<span class="required-color">*</span></h6>
                                    <input type="text" name="first_name" value="{{ !empty($employee) ? $employee->first_name : old('first_name') }}"
                                        class="form-control" id="first_name" autofocus placeholder="Enter First Name">
                                    <div class="text-muted">Enter First Name here</div>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <h6>Last Name<span class="required-color">*</span></h6>
                                    <input type="text" name="last_name" value="{{ !empty($employee) ? $employee->last_name : old('last_name') }}"
                                        class="form-control" id="last_name" autofocus placeholder="Enter Last Name">
                                    <div class="text-muted">Enter Last Name here</div>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <h6>Email<span class="required-color">*</span></h6>
                                    <input type="text" name="email" value="{{ !empty($employee) ? $employee->email : old('email') }}"
                                        class="form-control" id="email" autofocus placeholder="Enter Email">
                                    <div class="text-muted">Enter Email here</div>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <h6>Country Code<span class="required-color">*</span></h6>
                                    <select name="country_code" id="country_code"  style="width: 100%; padding: 10px; font-size: 16px;">
                                    <option value="+1" {{ isset($employee->country_code) && $employee->country_code == '+1' ? 'selected' : '' }}>US</option>
                                    <option value="+91" {{ isset($employee->country_code) && $employee->country_code == '+91' ? 'selected' : '' }}>India</option>
                                    </select>
                                    <div class="text-muted">Enter Country Code here</div>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <h6>Mobile No.<span class="required-color">*</span></h6>
                                    <input type="text" name="mobile_number" value="{{ !empty($employee) ? $employee->mobile_no : old('mobile_number') }}"
                                        class="form-control" id="mobile_number" autofocus placeholder="Enter Mobile No.">
                                    <div class="text-muted">Enter Mobile No. here</div>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <h6>Gender<span class="required-color">*</span></h6>
                                    <select name="gender" id="gender"  style="width: 100%; padding: 10px; font-size: 16px;">
                                        <option value="Male" {{ isset($employee->gender) && $employee->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ isset($employee->gender) && $employee->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ isset($employee->gender) && $employee->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    <div class="text-muted">Select Gender here</div>
                                </div>
                                @php
                                $hobbys = !empty($employee->hobby) ? json_decode($employee->hobby) : [];
                                @endphp
                                <div class="mb-3 col-md-12">
                                    <h6>Hobby<span class="required-color">*</span></h6>
                                        <label><input type="checkbox" name="hobby[]" value="Reading" {{ is_array($hobbys) && in_array('Reading', $hobbys) ? 'checked' : '' }}> Reading</label>
                                        <label><input type="checkbox" name="hobby[]" value="Traveling" {{ is_array($hobbys) && in_array('Traveling', $hobbys) ? 'checked' : '' }}> Traveling</label>
                                        <label><input type="checkbox" name="hobby[]" value="Cooking" {{ is_array($hobbys) && in_array('Cooking', $hobbys) ? 'checked' : '' }}> Cooking</label>
                                        <label><input type="checkbox" name="hobby[]" value="Sports" {{ is_array($hobbys) && in_array('Sports', $hobbys) ? 'checked' : '' }}> Sports</label>
                                        <label><input type="checkbox" name="hobby[]" value="Photography" {{ is_array($hobbys) && in_array('Photography', $hobbys) ? 'checked' : '' }}> Photography</label>
                                        <label><input type="checkbox" name="hobby[]" value="Music" {{ is_array($hobbys) && in_array('Music', $hobbys) ? 'checked' : '' }}> Music</label>
                                        <label><input type="checkbox" name="hobby[]" value="Gardening" {{ is_array($hobbys) && in_array('Gardening', $hobbys) ? 'checked' : '' }}> Gardening</label>
                                    <div class="text-muted">Select Gender here</div>
                                </div>

                                <div class="mb-3 col-md-12">
                                    <h6 class="card-header p-0">Address</h6>
                                    <textarea name="address" rows="7" class="form-control" placeholder="Type Your Text Here">{{ !empty($employee) ? $employee->address : old('address') }}</textarea>
                                    <div class="text-muted">Add Address Here
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--row-->
                    </div>
                    <div class="mt-2 justify-content-start d-flex mt-5">
                        <button type="submit" class="btn  me-2 btnSave">Save</button>
                        <a href=""><button type="button" class="btn btnCancel";>Cancel</button></a>
                    </div>
                </div><!-- /col-md-8 -->
            </div><!-- /row mt-4 -->
    </div>
    </form>
    </div><!-- / Content -->
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- DatePicker Js Starts-->
    <script type="text/javascript" src="{{asset('/custome/js/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/custome/js/daterangepicker.js')}}"></script>
    <script src="{{ asset('vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <!-- DatePicker Js Ends-->
@endsection

@section('page-scripts')
    <script>
        $(document).ready(function() {
            $('#country_code').select2();
            $('#gender').select2();
        });

        var loadFile = function(event) {
            var offer_image_perview = document.getElementById('offer_image_perview');
            offer_image_perview.src = URL.createObjectURL(event.target.files[0]);
            offer_image_perview.onload = function() {
                URL.revokeObjectURL(offer_image_perview.src) // free memory
            }
        };
    </script>
@endsection
