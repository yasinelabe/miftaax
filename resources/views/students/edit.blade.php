@extends('layout.header')@section('content') <style>
    .top_nav {
        display: none !important;
    }

    .col-md-3.left_col {
        display: none !important;
    }

    .sidebar-menu {
        display: none !important;
    }

    footer {
        display: none !important;
    }

    body {
        background: white !important;
        overflow: auto;
    }

    .right_col {
        background: white !important;
        margin-top: 0 !important;
        height: auto;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <div class="clearfix"></div>
                </div>
                <div class="x_content"><br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST"
                        action="{{ route('students.update', $student->id) }}">@csrf @if (Session::has('success'))
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div id="alert" class="alert alert-success text-white  alert-dismissible"
                                        role="alert">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>{{ Session::get('success') }}</strong>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- display form validation errors --}}
                        @if ($errors->any())
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-sm-12" for="fullname">Fullname <span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-sm-12"><input type="text"
                                    value="{{ $student->fullname }}" id="fullname" name="fullname" required="required"
                                    class="form-control"></div>
                        </div>
                        <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                for="gender">Gender <span class="required">*</span></label>
                            <div class="col-sm-6">
                                <p style="margin-top:6px;">
                                    <input type="radio" class="flat" name="gender" id="genderM" value="male"
                                        @if ($student->gender == 'male') {{'checked'}} @endif
                                        required /> Male
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" class="flat" name="gender" id="genderF" value="female"
                                        @if ($student->gender == 'female') {{'checked'}}  @endif required /> Female
                                </p>
                            </div>
                        </div>
                        <div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12"
                                for="guardian_id">Guardian <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-sm-12"><select class="form-control" name="guardian_id">
                                    <option value="">Select Guardian </option>
                                    @foreach ($guardian_ids as $guardian_id)
                                        @if ($student->guardian_id == $guardian_id->id)
                                            <option selected value="{{ $guardian_id->id }}">{{ $guardian_id->fullname }}
                                            </option>
                                        @else
                                            <option value="{{ $guardian_id->id }}">{{ $guardian_id->fullname }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12"
                                for="date_of_birth">Date of birth <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-sm-12"><input type="date"
                                    value="{{ $student->date_of_birth }}" id="date_of_birth" name="date_of_birth"
                                    required="required" class="form-control"></div>
                        </div>
                        <div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12"
                                for="joined_date">Joined date <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-sm-12"><input type="date"
                                    value="{{ $student->joined_date }}" id="joined_date" name="joined_date"
                                    required="required" class="form-control"></div>
                        </div>
                        <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                for="address">Address <span class="required">*</span></label>
                            <div class="col-sm-6">
                                <select name="student_address_id" class="form-control">
                                    @foreach ($student_addresses as $address)
                                        <option value="{{ $address->id }}"> {{ $address->area }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12"
                                for="blood_group_id">Blood group <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-sm-12"><select class="form-control" name="blood_group_id">
                                    <option value="">Select Blood group </option>
                                    @foreach ($blood_group_ids as $blood_group_id)
                                        <option value="{{ $blood_group_id->id }}">{{ $blood_group_id->name }}
                                        </option>
                                    @endforeach
                                </select></div>
                        </div>
                        <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                for="has_medical_emergency">Has medical emergency <span
                                    class="required">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="has_medical_emergency">

                                    <option value="">--</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                for="is_active">Is active <span class="required">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="is_active">

                                    <option value="">--</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                for="is_graduated">Is graduated <span class="required">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="is_graduated">

                                    <option value="">--</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12"
                                for="fee_amount">Fee amount <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-sm-12"><input type="text"
                                    value="{{ $student->fee_amount }}" id="fee_amount" name="fee_amount"
                                    required="required" class="form-control"></div>
                        </div>
                        <div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12"
                                for="fee_balance">Fee balance <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-sm-12"><input type="text"
                                    value="{{ $student->fee_balance }}" id="fee_balance" name="fee_balance"
                                    required="required" class="form-control"></div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-6 offset-3"><button type="submit" class="btn btn-sm btn-success"><i
                                        class="fa fa-save"></i> Save</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>@endsection
