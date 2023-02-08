@extends('layout.header')@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Library Member</h3>
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
                    <div class="x_content">
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
                        <br />
                        <form enctype="multipart/form-data" data-parsley-validate
                            class="form-horizontal form-label-left" method="POST"
                            action="{{ route('library_members.store') }}">@csrf<div class="item form-group"><label
                                    class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="library_member_type_id">Library member type <span
                                        class="required">*</span></label>
                                <div class="col-sm-6"><select onchange="handleMemberTypeChange(this)"
                                        class="form-control" name="library_member_type_id">
                                        <option value="">Select Library member type </option>
                                        @foreach ($library_member_type_ids as $library_member_type_id)
                                            <option value="{{ $library_member_type_id->id }}">
                                                {{ $library_member_type_id->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="member_id">Member <span class="required">*</span></label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="member_id" id="members">

                                    </select>`
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-6 offset-3"><button type="submit"
                                        class="btn btn-sm btn-success">Submit</button></div>
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
    function handleMemberTypeChange(target) {
        let list = ``
        switch (parseInt(target.options[target.options.selectedIndex].value)) {
            case 1:
                let students = JSON.parse(`@json($students)`)
                console.log(students)
                students.forEach(student => {
                    list += `<option value="${student.id}">${student.fullname}</option>`
                });

                $("#members").html(list)
                break;

            case 2:
                let teachers = JSON.parse(`@json($teachers)`)
                console.log(teachers)
                teachers.forEach(teacher => {
                    list += `<option value="${teacher.id}">${teacher.fullname}</option>`
                });

                $("#members").html(list)
                break;
            default:
                break;
        }

    }
</script>
@endsection
