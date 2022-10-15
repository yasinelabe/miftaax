@extends('layout.header')@section('content')<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Generate Marks Sheet</h3>
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
                            action="{{ route('exams.export_marks_sheet') }}">
                            @csrf
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="term_id">Class <span class="required">*</span></label>
                                <div class="col-sm-6"><select class="form-control" name="class_room">
                                        <option value="">Select Class </option>
                                        @foreach ($class_rooms as $class_room)
                                            <option value="{{ $class_room->id }}">{{ $class_room->name }}</option>
                                        @endforeach
                                    </select></div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="term_id">Exam <span class="required">*</span></label>
                                <div class="col-sm-6"><select class="form-control" name="exam">
                                        <option value="">Select Exam </option>
                                        @foreach ($exams as $exam)
                                            <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                                        @endforeach
                                    </select></div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="term_id">Subject <span class="required">*</span></label>
                                <div class="col-sm-6"><select class="form-control" name="subject">
                                        <option value="">Select subject </option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name .'('.$subject->code.')'  }}</option>
                                        @endforeach
                                    </select></div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-6 offset-3"><button type="submit"
                                        class="btn btn-sm btn-success">Generate</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>@endsection
