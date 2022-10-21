@extends('layout.header')@section('content')    <style>
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
    body{
        background:white !important;
        overflow:auto;
    }
    .right_col {
    background: white !important;
    margin-top: 0 !important;
    height: auto;
    }
  
    </style><div class="container"><div class="row"><div class="col-md-12 "><div class="x_panel"><div class="x_title"><div class="clearfix"></div></div><div class="x_content"><br /><form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ route('schedules.update', $schedule->id) }}">@csrf    @if(Session::has('success'))
    <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <p id="alert"
    class="alert alert-success text-white  alert-dismissible" role="alert">
    {{ Session::get('success') }}</p>
    </div>
    </div>
    @endif
    {{-- display form validation errors --}}
    @if($errors->any())
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
    @endif<div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12" for="teacher_id">Teacher  <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-sm-12"><select class="form-control" name="teacher_id"><option value="">Select Teacher </option>@foreach($teacher_ids as $teacher_id)<option value="{{ $teacher_id->id }}">{{ $teacher_id->name }}</option>@endforeach</select></div></div><div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12" for="subject_id">Subject  <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-sm-12"><select class="form-control" name="subject_id"><option value="">Select Subject </option>@foreach($subject_ids as $subject_id)<option value="{{ $subject_id->id }}">{{ $subject_id->name }}</option>@endforeach</select></div></div><div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12" for="class_room_id">Class room  <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-sm-12"><select class="form-control" name="class_room_id"><option value="">Select Class room </option>@foreach($class_room_ids as $class_room_id)<option value="{{ $class_room_id->id }}">{{ $class_room_id->name }}</option>@endforeach</select></div></div><div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12" for="day">Day <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-sm-12"><input type="text" value="{{ $schedule->day }}" id="day" name="day" required="required" class="form-control"></div></div><div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12" for="time_in">Time in <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-sm-12"><input type="text" value="{{ $schedule->time_in }}" id="time_in" name="time_in" required="required" class="form-control"></div></div><div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12" for="time_out">Time out <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-sm-12"><input type="text" value="{{ $schedule->time_out }}" id="time_out" name="time_out" required="required" class="form-control"></div></div><div class="ln_solid"></div><div class="item form-group"><div class="col-6 offset-3"><button type="submit" class="btn btn-sm btn-success">Submit</button></div></div></form></div></div></div></div></div>@endsection