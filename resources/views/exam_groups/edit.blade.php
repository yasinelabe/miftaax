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
                        action="{{ route('exam_groups.update', $examgroup->id) }}">@csrf @if (Session::has('success'))
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <p id="alert" class="alert alert-success text-white  alert-dismissible"
                                        role="alert">
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
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-sm-12" for="name">Name <span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-sm-12"><input type="text"
                                    value="{{ $examgroup->name }}" id="name" name="name" required="required"
                                    class="form-control"></div>
                        </div>
                        <div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12"
                                for="description">Description <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-sm-12"><input type="text"
                                    value="{{ $examgroup->description }}" id="description" name="description"
                                    required="required" class="form-control"></div>
                        </div>
                        <div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12"
                                for="exam_type_id">Exam type <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-sm-12"><select class="form-control" name="exam_type_id">
                                    <option value="">Select Exam type </option>
                                    @foreach ($exam_type_ids as $exam_type_id)
                                        <option value="{{ $exam_type_id->id }}">{{ $exam_type_id->name }}</option>
                                    @endforeach
                                </select></div>
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
