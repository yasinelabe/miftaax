@extends('layout.header')@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>TeacherSubject</h3>
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
                            action="{{ route('teacher_subjects.store') }}">@csrf<div class="item form-group"><label
                                    class="col-form-label col-md-3 col-sm-3 label-align" for="teacher_id">Teacher <span
                                        class="required">*</span></label>
                                <div class="col-sm-6"><select class="form-control" name="teacher_id">
                                        <option value="">Select Teacher </option>
                                        @foreach ($teacher_ids as $teacher_id)
                                            <option value="{{ $teacher_id->id }}">{{ $teacher_id->fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="subject_id">Subject <span class="required">*</span></label>
                                <div class="col-sm-6"><select class="form-control" name="subject_id">
                                        <option value="">Select Subject </option>
                                        @foreach ($subject_ids as $subject_id)
                                            <option value="{{ $subject_id->id }}">{{ $subject_id->name }}</option>
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
