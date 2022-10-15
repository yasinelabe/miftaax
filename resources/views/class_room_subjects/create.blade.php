@extends('layout.header')@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>ClassRoomSubject</h3>
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
                            action="{{ route('class_room_subjects.store') }}">@csrf<div class="item form-group"><label
                                    class="col-form-label col-md-3 col-sm-3 label-align" for="class_room_id">Class room
                                    <span class="required">*</span></label>
                                <div class="col-sm-6"><select class="form-control" name="class_room_id">
                                        <option value="">Select Class room </option>
                                        @foreach ($class_room_ids as $class_room_id)
                                            <option value="{{ $class_room_id->id }}">{{ $class_room_id->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="subject_group_id">Subject group <span class="required">*</span></label>
                                <div class="col-sm-6"><select class="form-control" name="subject_group_id">
                                        <option value="">Select Subject group </option>
                                        @foreach ($subject_group_ids as $subject_group_id)
                                            <option value="{{ $subject_group_id->id }}">{{ $subject_group_id->name }}
                                            </option>
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
