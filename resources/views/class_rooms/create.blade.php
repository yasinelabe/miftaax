@extends('layout.header')@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>ClassRoom</h3>
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
                            action="{{ route('class_rooms.store') }}">@csrf<div class="item form-group"><label
                                    class="col-form-label col-md-3 col-sm-3 label-align" for="name">Name <span
                                        class="required">*</span></label>
                                <div class="col-sm-6"><input type="text" id="name" name="name"
                                        required="required" class="form-control "></div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="academic_year_id">Academic year <span class="required">*</span></label>
                                <div class="col-sm-6"><select class="form-control" name="academic_year_id">
                                        <option value="">Select Academic year </option>
                                        @foreach ($academic_year_ids as $academic_year_id)
                                            <option value="{{ $academic_year_id->id }}">{{ $academic_year_id->year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="shift_id">Shift <span class="required">*</span></label>
                                <div class="col-sm-6"><select class="form-control" name="shift_id">
                                        <option value="">Select Shift </option>
                                        @foreach ($shift_ids as $shift_id)
                                            <option value="{{ $shift_id->id }}">{{ $shift_id->name }}</option>
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
