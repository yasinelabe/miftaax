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
                    <h4 class="modal-title" id="myModalLabel">Edit Schedule</h4>
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
                    <p>Are you sure you want to delete this Schedule?</p>
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
                        <h2><a href="/schedules/create" class="btn btn-sm btn-success"><i class="fa fa-plus text-white"></i>
                                Schedule</a></h2>
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
                        <form class="row" action="{{ route('schedules.index') }}" method="post">
                            @csrf
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Class</label><small class="req"> *</small>
                                    <select id="class_room_id" name="class_room_id" class="form-control">
                                        <option value="">Select</option>
                                        @foreach ($class_rooms as $class_room)
                                            <option value="{{ $class_room->id }}">{{ $class_room->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Teacher</label><small class="req"> *</small>
                                    <select id="teacher_id" name="teacher_id" class="form-control">
                                        <option value="">Select</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->fullname }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>...</label>
                                    <button type="submit" class="btn btn-success form-control"><i class="fa fa-search"></i>
                                        Search</button>
                                </div>
                            </div>

                        </form>


                        <br />
                        <br />

                        <div class="row">

                            @php
                                
                                $days = ['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thrustday', 'friday'];
                            @endphp
                            @foreach ($days as $day)
                                <div class="col-3">
                                    <div class="card mt-4">
                                        <div class="card-header bg-success text-white">
                                            {{ ucfirst($day) }}
                                        </div>

                                        <div class="card-body">
                                            @foreach ($schedules as $schedule)
                                                @if ($schedule->day == $day)
                                                    <p>
                                                        <b>Subject:</b> {{ $schedule->subject->name }} <br />
                                                        <b> Time:</b> {{ $schedule->time_in }} - {{ $schedule->time_out }}
                                                        <br />
                                                        <b>Teacher:</b> {{ $schedule->teacher->fullname }}
                                                    </p>

                                                    <hr>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>



                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        function delete_id(id) {
            document.getElementById("delete").action = "/schedules/" + id + "/delete";
        }

        function initializeIframe(url) {
            var iframe = document.getElementById("iframe");
            iframe.src = url;
        }
    </script>
@endsection
