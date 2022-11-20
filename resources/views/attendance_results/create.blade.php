@extends('layout.header')@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>AttendanceResult</h3>
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
                            action="{{ route('attendance_results.store') }}">@csrf<div class="item form-group"><label
                                    class="col-form-label col-md-3 col-sm-3 label-align" for="attendance_id">Attendance
                                    <span class="required">*</span></label>
                                <div class="col-sm-6"><select class="form-control" name="attendance_id">
                                        <option value="">Select Attendance </option>
                                        @foreach ($attendance_ids as $attendance_id)
                                            <option value="{{ $attendance_id->id }}">{{ $attendance_id->attendance_date .'-'. $attendance_id->class_room->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="student_id">Student <span class="required">*</span></label>
                                <div class="col-sm-6"><select class="form-control" name="student_id">
                                        <option value="">Select Student </option>
                                        @foreach ($student_ids as $student_id)
                                            <option value="{{ $student_id->id }}">{{ $student_id->fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="attendance_result_status_id">Attendance result status <span
                                        class="required">*</span></label>
                                <div class="col-sm-6"><select class="form-control" name="attendance_result_status_id">
                                        <option value="">Select Attendance result status </option>
                                        @foreach ($attendance_result_status_ids as $attendance_result_status_id)
                                            <option value="{{ $attendance_result_status_id->id }}">
                                                {{ $attendance_result_status_id->name }}</option>
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
