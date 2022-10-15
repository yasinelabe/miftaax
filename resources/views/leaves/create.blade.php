@extends('layout.header')@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Leave</h3>
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
                        <form enctype="multipart/form-data" data-parsley-validate
                            class="form-horizontal form-label-left" method="POST" action="{{ route('leaves.store') }}">
                            @csrf
                            @if (Session::has('success'))
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <p id="alert" class="alert alert-success text-white  alert-dismissible" role="alert">
                                            {{ Session::get('success') }}</p>
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
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="student_id">Student <span class="required">*</span></label>
                                <div class="col-sm-6"><select class="form-control" name="student_id">
                                        <option value="">Select Student </option>
                                        @foreach ($student_ids as $student_id)
                                            <option value="{{ $student_id->id }}">
                                                {{ $student_id->id . '-' . $student_id->fullname }}</option>
                                        @endforeach
                                    </select></div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="apply_date">Apply date <span class="required">*</span></label>
                                <div class="col-sm-6"><input type="date" id="apply_date" name="apply_date"
                                        required="required" class="form-control "></div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="from_date">From date <span class="required">*</span></label>
                                <div class="col-sm-6"><input type="date" id="from_date" name="from_date"
                                        required="required" class="form-control "></div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="to_date">To date <span class="required">*</span></label>
                                <div class="col-sm-6"><input type="date" id="to_date" name="to_date"
                                        required="required" class="form-control "></div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="reason">Reason <span class="required">*</span></label>
                                <div class="col-sm-6"><input type="text" id="reason" name="reason"
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
</div>
@endsection
