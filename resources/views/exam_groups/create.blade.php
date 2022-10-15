@extends('layout.header')@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>ExamGroup</h3>
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
                            class="form-horizontal form-label-left" method="POST"
                            action="{{ route('exam_groups.store') }}">@csrf<div class="item form-group"><label
                                    class="col-form-label col-md-3 col-sm-3 label-align" for="name">Name <span
                                        class="required">*</span></label>
                                <div class="col-sm-6"><input type="text" id="name" name="name"
                                        required="required" class="form-control "></div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="description">Description <span class="required">*</span></label>
                                <div class="col-sm-6"><input type="text" id="description" name="description"
                                        required="required" class="form-control "></div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="exam_type_id">Exam type <span class="required">*</span></label>
                                <div class="col-sm-6"><select class="form-control" name="exam_type_id">
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
    </div>
</div>
</div>
@endsection
