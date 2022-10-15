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
                        action="{{ route('leaves.update', $leave->id) }}">@csrf @if (Session::has('success'))
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div id="alert" class="alert alert-success text-white  alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                            <label class="control-label col-md-3 col-sm-3 col-sm-12" for="student_id">Student <span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-sm-12"><select class="form-control" name="student_id">
                                    <option value="">Select Student </option>
                                    @foreach ($student_ids as $student_id)
                                        <option value="{{ $student_id->id }}">{{ $student_id->id.'-'.$student_id->fullname }}</option>
                                    @endforeach
                                </select></div>
                        </div>
                        <div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12"
                                for="apply_date">Apply date <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-sm-12"><input type="date"
                                    value="{{ $leave->apply_date }}" id="apply_date" name="apply_date"
                                    required="required" class="form-control"></div>
                        </div>
                        <div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12"
                                for="from_date">From date <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-sm-12"><input type="date"
                                    value="{{ $leave->from_date }}" id="from_date" name="from_date" required="required"
                                    class="form-control"></div>
                        </div>
                        <div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12"
                                for="to_date">To date <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-sm-12"><input type="date" value="{{ $leave->to_date }}"
                                    id="to_date" name="to_date" required="required" class="form-control"></div>
                        </div>
                        <div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12"
                                for="reason">Reason <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-sm-12"><input type="text" value="{{ $leave->reason }}"
                                    id="reason" name="reason" required="required" class="form-control"></div>
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
</div>@endsection
