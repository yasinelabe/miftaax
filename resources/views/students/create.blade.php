@extends('layout.header')@section('content')
<style>
    .modal-lg,
    .modal-xl {
        max-width: 70%;
        margin-left: 15%;
    }

    .model-content {
        height: 70vh !important;
    }
</style>
<div class="modal fade bs-example-modal-lg" id="add_guardian" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add guardian</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="iframe" src="/guardians/create?iframe=true" title="description"></iframe>
            </div>
        </div>
    </div>
</div>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Student</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content"><br />
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="row">
                                    <div class="col-md-12">
                                        <p id="alert" class="alert alert-danger">
                                            {{ $error }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <form enctype="multipart/form-data" data-parsley-validate
                            class="form-horizontal form-label-left" method="POST"
                            action="{{ route('students.store') }}">
                            @csrf<div class="item form-group"><label
                                    class="col-form-label col-md-3 col-sm-3 label-align" for="fullname">Fullname <span
                                        class="required">*</span></label>
                                <div class="col-sm-6"><input type="text" id="fullname" name="fullname"
                                        required="required" class="form-control "></div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="gender">Gender <span class="required">*</span></label>
                                <div class="col-sm-6">
                                    <p style="margin-top:6px;">

                                        <input type="radio" class="flat" name="gender" id="genderM"
                                            value="male" checked="" required /> Male &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" class="flat" name="gender" id="genderF"
                                            value="female" /> Female
                                    </p>
                                </div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="guardian_id">Guardian <span class="required">*</span></label>
                                <div class="col-sm-6"><select class="form-control" name="guardian_id">
                                        <option value="">Select Guardian </option>
                                        @foreach ($guardian_ids as $guardian_id)
                                            <option value="{{ $guardian_id->id }}">{{ $guardian_id->fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <a href="#" class="btn btn-sm btn-success" data-target="#add_guardian"
                                        data-toggle="modal">
                                        <i class="fa fa-plus"></i>
                                </a>
                                </div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="date_of_birth">Date of birth <span class="required">*</span></label>
                                <div class="col-sm-6"><input type="date" id="date_of_birth" name="date_of_birth"
                                        required="required" class="form-control "></div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="joined_date">Joined date <span class="required">*</span></label>
                                <div class="col-sm-6"><input type="date" id="joined_date" name="joined_date"
                                        required="required" class="form-control "></div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="address">Address <span class="required">*</span></label>
                                <div class="col-sm-6">
                                <select name="student_address_id" class="form-control">
                                    @foreach($student_addresses as $address)
                                               <option value="{{$address->id}}"> {{$address->area}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="blood_group_id">Blood group <span class="required">*</span></label>
                                <div class="col-sm-6"><select class="form-control" name="blood_group_id">
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
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="fee_amount">Fee amount <span class="required">*</span></label>
                                <div class="col-sm-6"><input type="text" id="fee_amount" name="fee_amount"
                                        required="required" class="form-control "></div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="fee_balance">Fee balance <span class="required">*</span></label>
                                <div class="col-sm-6"><input type="text" id="fee_balance" name="fee_balance"
                                        required="required" class="form-control "></div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-6 offset-3"><button type="submit"
                                        class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>@endsection
