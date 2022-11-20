@extends('layout.header') @section('content')
    <style>
        .modal-lg,
        .modal-xl {
            max-width: 70%;
            margin-left: 15%;
        }

        .model-content {
            height: 70vh !important;
        }
    </style>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit AttendanceResult</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="iframe" title="description"></iframe>
                </div>
            </div>
        </div>
    </div>


    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
            </div>
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Student Attendance Report</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (Session::has('success'))
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="alert" class="alert alert-success text-white  alert-dismissible"
                                        role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                        <strong>{{ Session::get('success') }}</strong>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <form class="row" action="{{ route('attendance_results.index') }}" method="post">
                            @csrf
                            <div class="col-sm-6 col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label>Date</label><small class="req"> *</small>
                                    <input type="date" name="attendance_date" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label>Class</label><small class="req"> *</small>
                                    <select id="class_room_id" name="class_room_id" class="form-control" required>
                                        <option value="">Select</option>
                                        @foreach ($active_classes as $class_room)
                                            <option value="{{ $class_room->id }}">{{ $class_room->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label>...</label>
                                    <button type="submit" class="btn btn-success form-control"><i class="fa fa-search"></i>
                                        Search</button>
                                </div>
                            </div>

                        </form>

                        <br />
                        <br />
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">



                                    <table id="datatable-buttons"
                                        class="table jambo_table  table-striped  table-bordered dataTable no-footer dtr-inline"
                                        style="width: 100%;" role="grid" aria-describedby="datatable-buttons_info">
                                        <thead>
                                            <tr role="row">
                                                <th>Id</th>
                                                <th>Attendance Date</th>
                                                <th>Student ID</th>
                                                <th>Student Name </th>
                                                <th>Attendance result status </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (gettype($attendance_results) != 'array')
                                                @foreach ($attendance_results as $attendanceresult)
                                                    <tr role="row" class="odd">
                                                        <td>{{ $attendanceresult->id }}</td>
                                                        <td>{{ $attendanceresult->attendance->attendance_date . ' ( ' . $attendanceresult->attendance->class_room->name .' )' }}
                                                        </td>
                                                        <td>{{ $attendanceresult->student->id }}</td>
                                                        <td>{{ $attendanceresult->student->fullname }}</td>
                                                        <td>
                                                            @if ($attendanceresult->attendance_result_status->name == 'Absent')
                                                                <span
                                                                    class="badge badge-danger">{{ $attendanceresult->attendance_result_status->name }}</span>
                                                            @else
                                                                {{ $attendanceresult->attendance_result_status->name }}
                                                            @endif

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td>
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        <h5>No results found</h5>
                                                    </td>

                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function delete_id(id) {
            document.getElementById("delete").action = "/attendance_results/" + id + "/delete";
        }

        function initializeIframe(url) {
            var iframe = document.getElementById("iframe");
            iframe.src = url;
        }
    </script>
@endsection
