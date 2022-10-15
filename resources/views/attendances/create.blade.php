@extends('layout.header')@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Attendance</h3>
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
                            action="{{ route('attendances.store') }}">@csrf
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="date" id="attendance_date" name="attendance_date"
                                            required="required" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class=" form-group">
                                        <select class="form-control" id="class_rooms" name="class_room_id">
                                            <option value="">Select Class room </option>
                                            @foreach ($class_room_ids as $class_room_id)
                                                <option value="{{ $class_room_id->id }}">{{ $class_room_id->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <a href="#" onclick="searchStudents(event)" class="btn btn-success"><i class="fa fa-search"></i>
                                        Search</a>
                                </div>
                            </div>
                            <div class="ln_solid"></div>

                            <h5>Students List</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>StudentID</th>
                                        <th>Full Name</th>
                                        <th>Attendance</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                               
                                <tbody id="tbody">
                                    
                                </tbody>
                            </table>


                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="text-right">
                                    <button style="display: none;" id="submit" class="btn btn-sm btn-success" type="submit"> <i class="fa fa-save"></i> Save Attendance</button>
                                </div>
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
    function searchStudents(event) {
        event.preventDefault();

        $class_room = $("#class_rooms :selected").val()

        let tbody = document.getElementById('tbody');


        $.ajax({
            type: "get",
            url: "/class_rooms/get_class_students/" + $class_room,
            success: function(response) {
                students = response
                if (Object.keys(students).length < 1) {
                    $("#table_data").html(
                        "<tr><td rowspan='3'><h5 class='text-warning'><i class='fa fa-trash'></i> No students are in this class.</h5></td></tr>"
                    )
                    $("#submit").hide()
                    return false;
                }
                students.forEach(student => {
                        tr = document.createElement('tr')
                        tr.id = student.id
                        tr.innerHTML = `
                                <td>${student.id}<input type="hidden" name="students[]" value="${student.id}"></td>
                                <td>${student.fullname}</td>
                                <td>
                                    @foreach ($statuses as $status)
                                        <div class="radio radio-info radio-inline">
                                            <input @if ($status->id == 1) {{ 'checked' }} @endif
                                                type="radio" id="attendance_status_{{ $status->id }}"
                                                value="{{ $status->id }}" name="statuses_${student.id}"
                                                autocomplete="off">

                                            <label for="attendance_status_{{ $status->id }}">
                                                {{ $status->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </td>
                                <td><textarea class="form-control" type="text" name="notes[]"></textarea></td>
                        `
                        tbody.appendChild(tr)
                });

                $("#submit").show()
                

            },
        });
    }

</script>
@endsection
