@extends('layout.header')@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Admit in batches</h3>
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
                            action="{{ route('student_class_rooms.store') }}?batch=true">

                            @csrf

                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="class_room_id">Class room <span class="required">*</span></label>
                                <div class="col-sm-6"><select class="form-control" name="class_room_id">
                                        <option value="">Select Class room </option>
                                        @foreach ($class_room_ids as $class_room_id)
                                            <option value="{{ $class_room_id->id }}">{{ $class_room_id->name }}</option>
                                        @endforeach
                                    </select></div>
                            </div>

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th><input onclick="checkOrUncheckAll(this,'students')" type="checkbox"
                                                class="input-check"></th>
                                        <th> StudentID </th>
                                        <th> Student Name </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($student_ids as $student_id)
                                    <tr>
                                            <td><input type="checkbox" class="input-check students"
                                                    value="{{ $student_id->id }}" name="students[]"></td>
                                            <td>
                                                {{ $student_id->id }}
                                            </td>
                                            <td>
                                                {{ $student_id->fullname }}
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>

                            </table>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i>
                                        Save</button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    function checkOrUncheckAll(target, boxclass) {
        var selected = target.checked;
        // Iterate each checkbox
        $('.' + boxclass).each(function() {
            this.checked = selected;
        });
    }
</script>
@endsection
