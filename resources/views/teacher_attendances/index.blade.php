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
                    <h4 class="modal-title" id="myModalLabel">Edit TeacherAttendance</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="iframe" title="description"></iframe>
                </div>
            </div>
        </div>
    </div>

    {{--  warning modal before delete --}}
    <div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" method="get" id="delete">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this TeacherAttendance?</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-danger" id="delete">Delete</button>
                </div>
            </form>
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
                        <h2><a href="/teacher_attendances/create" class="btn btn-sm btn-success"><i
                                    class="fa fa-plus text-white"></i> TeacherAttendance</a></h2>
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
                                    <p id="alert" class="alert alert-success text-white  alert-dismissible"
                                        role="alert">
                                        {{ Session::get('success') }}</p>
                                </div>
                            </div>
                        @endif

                        <form class="row" action="{{ route('teacher_attendances.index') }}" method="post">
                            @csrf
                            <div class="col-sm-6 col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label>Month</label><small class="req"> *</small>
                                    <select name="month" id="" class="form-control" required>
                                        <option value=""></option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label>Teacher</label><small class="req"> *</small>
                                    <select id="class_room_id" name="teacher_id" class="form-control" required>
                                        <option value="">Select</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->fullname }}</option>
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


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-buttons"
                                        class="table jambo_table  table-striped  table-bordered dataTable no-footer dtr-inline"
                                        style="width: 100%;" role="grid" aria-describedby="datatable-buttons_info">
                                        <thead>
                                            <tr role="row">
                                                <th>Id</th>
                                                <th>Is absent</th>
                                                <th>Teacher </th>
                                                <th>Created Date</th>
                                                <th>Time in</th>
                                                <th>Time out</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($teacher_attendances as $teacherattendance)
                                                <tr role="row" class="odd">
                                                    <td>{{ $teacherattendance->id }}</td>
                                                    @if ($teacherattendance->is_absent == 1)
                                                        <td>Yes</td>
                                                        <td>{{ $teacherattendance->teacher->fullname }}</td>
                                                        <td>{{ $teacherattendance->created_at }}</td>
                                                        <td></td>
                                                        <td></td>
                                                    @else
                                                        <td>No</td>
                                                        <td>{{ $teacherattendance->teacher->fullname }}</td>
                                                        <td>{{ $teacherattendance->created_at }}</td>
                                                        <td>{{ $teacherattendance->time_in }}</td>
                                                        <td>{{ $teacherattendance->time_out }}</td>
                                                    @endif
                                                    <td>
                                                        @if ($teacherattendance->time_out == null && $teacherattendance->is_absent != 1)
                                                            <a href="#" data-toggle="modal"
                                                                data-target=".bs-example-modal-lg"
                                                                onclick="initializeIframe('{{ route('teacher_attendances.edit', $teacherattendance->id) }}')"><i
                                                                    class="fa fa-pencil"></i> Add Clock Out </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
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
            document.getElementById("delete").action = "/teacher_attendances/" + id + "/delete";
        }

        function initializeIframe(url) {
            var iframe = document.getElementById("iframe");
            iframe.src = url;
        }
    </script>
@endsection
