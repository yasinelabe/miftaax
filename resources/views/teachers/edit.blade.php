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
  
    </style><div class="container"><div class="row"><div class="col-md-12 "><div class="x_panel"><div class="x_title"><div class="clearfix"></div></div><div class="x_content"><br /><form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ route('teachers.update', $teacher->id) }}">@csrf    @if(Session::has('success'))
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
    @endif<div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12" for="fullname">Fullname <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-sm-12"><input type="text" value="{{ $teacher->fullname }}" id="fullname" name="fullname" required="required" class="form-control"></div></div><div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12" for="salary">Salary <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-sm-12"><input type="text" value="{{ $teacher->salary }}" id="salary" name="salary" required="required" class="form-control"></div></div><div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align" for="gender">Gender <span class="required">*</span></label><div class="col-sm-6"><p style="margin-top:6px;">
                <input type="radio" class="flat" name="gender" id="genderM" value="male" 
                @if($teacher->gender == "male")
                    <?php echo "checked"?>
                @endif
                required /> Male &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="flat" name="gender" id="genderF" value="female" 
                @if($teacher->gender == "female")
                    <?php echo "checked"?>
                @endif
                /> Female
            </p>
                </div></div><div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12" for="tell">Tell <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-sm-12"><input type="text" value="{{ $teacher->tell }}" id="tell" name="tell" required="required" class="form-control"></div></div><div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12" for="blood_group_id">Blood group  <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-sm-12"><select class="form-control" name="blood_group_id"><option value="">Select Blood group </option>@foreach($blood_group_ids as $blood_group_id)<option value="{{ $blood_group_id->id }}">{{ $blood_group_id->name }}</option>@endforeach</select></div></div><div class="ln_solid"></div><div class="item form-group"><div class="col-6 offset-3"><button type="submit" class="btn btn-sm btn-success">Submit</button></div></div></form></div></div></div></div></div>@endsection