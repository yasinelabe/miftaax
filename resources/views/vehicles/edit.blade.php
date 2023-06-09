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
  
    </style><div class="container"><div class="row"><div class="col-md-12 "><div class="x_panel"><div class="x_title"><div class="clearfix"></div></div><div class="x_content"><br /><form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ route('vehicles.update', $vehicle->id) }}">@csrf    @if(Session::has('success'))
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
    @endif<div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12" for="plate_number">Plate number <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-sm-12"><input type="text" value="{{ $vehicle->plate_number }}" id="plate_number" name="plate_number" required="required" class="form-control"></div></div><div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12" for="vehicle_model">Vehicle model <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-sm-12"><input type="text" value="{{ $vehicle->vehicle_model }}" id="vehicle_model" name="vehicle_model" required="required" class="form-control"></div></div><div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12" for="year_made">Year made <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-sm-12"><input type="text" value="{{ $vehicle->year_made }}" id="year_made" name="year_made" required="required" class="form-control"></div></div><div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12" for="registration_number">Registration number <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-sm-12"><input type="text" value="{{ $vehicle->registration_number }}" id="registration_number" name="registration_number" required="required" class="form-control"></div></div><div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align" for="chasis_number">Chasis number <span class="required">*</span></label><div class="col-sm-6">
                <select class="form-control"  name="chasis_number">

                            <option value="">--</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                    </select>
                </div></div><div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12" for="max_seating_capacity">Max seating capacity <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-sm-12"><input type="text" value="{{ $vehicle->max_seating_capacity }}" id="max_seating_capacity" name="max_seating_capacity" required="required" class="form-control"></div></div><div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12" for="driver_name">Driver name <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-sm-12"><input type="text" value="{{ $vehicle->driver_name }}" id="driver_name" name="driver_name" required="required" class="form-control"></div></div><div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12" for="driver_licence">Driver licence <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-sm-12"><input type="text" value="{{ $vehicle->driver_licence }}" id="driver_licence" name="driver_licence" required="required" class="form-control"></div></div><div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12" for="driver_contact">Driver contact <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-sm-12"><input type="text" value="{{ $vehicle->driver_contact }}" id="driver_contact" name="driver_contact" required="required" class="form-control"></div></div><div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12" for="image">Image <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-sm-12"><input type="text" value="{{ $vehicle->image }}" id="image" name="image" required="required" class="form-control"></div></div><div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-sm-12" for="note">Note <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-sm-12"><input type="text" value="{{ $vehicle->note }}" id="note" name="note" required="required" class="form-control"></div></div><div class="ln_solid"></div><div class="item form-group"><div class="col-6 offset-3"><button type="submit" class="btn btn-sm btn-success">Submit</button></div></div></form></div></div></div></div></div>@endsection