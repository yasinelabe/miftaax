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
                    <h4 class="modal-title" id="myModalLabel">Edit Shift</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="iframe" title="description"></iframe>
                </div>
            </div>
        </div>
    </div>

    {{-- warning modal before delete --}}
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
                    <p>Are you sure you want to delete this Shift?</p>
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
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
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

                        @if (Session::has('success'))
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="alert" class="alert alert-success text-white  alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>{{ Session::get('success') }}</strong>
                        </div>
                                </div>
                            </div>
                        @endif


                        <form class="row">
                            <div class="card-box table-responsive">
                                <div class="col-sm-6">
                                    <div class="col">
                                        <select name="class_id" id="class_rooms" class="form-control">
                                            <option value="">-class room-</option>
                                            @foreach ($class_rooms as $class_room)
                                                <option value="{{ $class_room->id }}">{{ $class_room->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="col">
                                        <button onclick="searchStudents(event)" class="btn btn-success" id="find_students">
                                            <i class="fa fa-search"> </i> Search
                                        </button>
                                    </div>
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
                                                <th>StudentID</th>
                                                <th>Student Fullname</th>
                                                <th>Class</th>
                                                <th>Unpaid Total</th>
                                                <th>Fee Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table_data">

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
        function searchStudents(event) {
            event.preventDefault();

            class_room = $("#class_rooms :selected").val()
            class_room_name = $("#class_rooms :selected").text()
            let table = $('#datatable-buttons').DataTable();


            $.ajax({
                type: "get",
                url: "/fees/search_paid_list/" + class_room,
                success: function(response) {
                    students = response

                    students.forEach(student => {
                        if (student.fee_balance == 0 && student.fee_amount != 0) {
                            tr = document.createElement('tr')
                            tr.id = student.id
                            tr.innerHTML = `
                                <td>${student.id}</td>
                                <td>${student.fullname}</td>
                                <td>${class_room_name}</td>
                                <td>${student.fee_balance}</td>
                                <td>${student.fee_amount}</td>
                        `
                            table.row.add(tr).draw();
                        }
                    });

                },
            });
        }
    </script>
@endsection
