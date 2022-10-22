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
                                    <div id="alert" class="alert alert-success text-white  alert-dismissible"
                                        role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                        <strong>{{ Session::get('success') }}</strong>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">Collect
                                    By Student</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="fees-tab" data-toggle="tab" href="#fees" role="tab"
                                    aria-controls="fees" aria-selected="false">Collect By Class</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <br />
                                <br />

                                <form class="card-body" action="{{ route('fees.save_student_payment') }}" method="post">
                                    @csrf
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="from_marks">Fee
                                            <span class="required">*</span></label>
                                        <div class="col-sm-6">
                                            <select name="fee_id" class="form-control">
                                                <option value="">-Fee-</option>
                                                @foreach ($fees as $fee)
                                                    <option value="{{ $fee->id }}">
                                                        {{ $fee->description . $fee->month }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="from_marks">Class
                                            <span class="required">*</span></label>
                                        <div class="col-sm-6">
                                            <select id="class_rooms2" onchange="getStudents(event)" name="class_id"
                                                class="form-control ">
                                                <option value="">Select</option>
                                                @foreach ($class_rooms as $class_room)
                                                    <option value="{{ $class_room->id }}">{{ $class_room->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align"
                                            for="from_marks">Student
                                            <span class="required">*</span></label>

                                        <div class="col-sm-6">
                                            <select id="students2" name="student_id" class="form-control ">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align"
                                            for="from_marks">Amount
                                            <span class="required">*</span></label>

                                        <div class="col-sm-6">
                                            <input type="number" min="0.01" step="0.01" id="amount"
                                                name="amount" class="form-control ">

                                        </div>
                                    </div>


                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align"
                                            for="from_marks">Payment method
                                            <span class="required">*</span></label>

                                        <div class="col-sm-6">
                                            <select name="receiving_account_id" required="required" class="form-control"
                                                required>
                                                <option value="">Select Payment Method</option>
                                                @foreach ($cash_accounts as $cash_account)
                                                    <option value="{{ $cash_account->id }}">
                                                        {{ $cash_account->account_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-6">
                                            <button class="btn btn-sm btn-success">
                                                <i class="fa fa-search"> </i> Save Payment
                                            </button>
                                        </div>
                                    </div>



                                </form>
                            </div>
                            <div class="tab-pane fade" id="fees" role="tabpanel" aria-labelledby="profile-tab">
                                <br />
                                <br />

                                <form class="row">
                                    <div class="card-box table-responsive">
                                        <div class="col-sm-3">
                                            <div class="col">
                                                <select name="class_id" id="class_rooms" class="form-control ">
                                                    @foreach ($class_rooms as $class_room)
                                                        <option value="{{ $class_room->id }}">{{ $class_room->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="col">
                                                <select onchange="feeChange(this)" name="fee_id" id="fee"
                                                    class="form-control">
                                                    <option value="">-Fee-</option>
                                                    @foreach ($fees as $fee)
                                                        <option value="{{ $fee->id }}">
                                                            {{ $fee->description . $fee->month }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3 ">
                                            <select onchange="accountChange(this)" required="required"
                                                class="form-control" required>
                                                <option value="">Select Payment Method</option>
                                                @foreach ($cash_accounts as $cash_account)
                                                    <option value="{{ $cash_account->id }}">
                                                        {{ $cash_account->account_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="col">
                                                <button onclick="searchStudents(event)" class="btn btn-success"
                                                    id="find_students">
                                                    <i class="fa fa-search"> </i> Search
                                                </button>
                                            </div>
                                        </div>




                                    </div>
                                </form>


                                <form action="{{ route('fees.save_payments') }}" method="post" class="container">
                                    @csrf
                                    <input type="hidden" id="fee_id" name="fee_id">
                                    <input type="hidden" id="receiving_account_id" name="receiving_account_id">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card-box table-responsive">
                                                <table id="datatable-buttons"
                                                    class="table jambo_table  table-striped  table-bordered dataTable no-footer dtr-inline"
                                                    style="width: 100%;" role="grid"
                                                    aria-describedby="datatable-buttons_info">
                                                    <thead>
                                                        <tr role="row">
                                                            <th>StudentID</th>
                                                            <th>Student Fullname</th>
                                                            <th>Unpaid Total</th>
                                                            <th>Fee Amount</th>
                                                            <th>Paid Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_data">

                                                    </tbody>


                                                </table>


                                            </div>
                                        </div>
                                    </div>

                                    <br><br>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-right">
                                                <button style="display:none;" class="btn btn-sm btn-success"
                                                    id="submit">
                                                    Save Payments
                                                </button>
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
        function feeChange(target) {
            const current_fee = target.options[target.options.selectedIndex].value;
            document.getElementById('fee_id').value = current_fee;
        }

        function accountChange(target) {
            const current_account = target.options[target.options.selectedIndex].value;
            document.getElementById('receiving_account_id').value = current_account;
        }


        function getStudents(event) {
            event.preventDefault();
            let ClassRoom = $('#class_rooms2').find(':selected').val();
            let studentSelect = $('#students2');
            studentSelect.val(null).trigger('change');
            $.ajax({
                type: "get",
                url: "/class_rooms/get_class_students/" + ClassRoom,
                success: function(students) {
                    students.forEach(student => {
                        let option = new Option(student.id + '-' + student.fullname, student.id, true,
                            true);
                        studentSelect.append(option).trigger('change');
                    })

                }
            });
        }

        function searchStudents(event) {
            event.preventDefault();

            $class_room = $("#class_rooms :selected").val()

            let table = $('#datatable-buttons').DataTable();


            $.ajax({
                type: "get",
                url: "/class_rooms/get_class_students/" + $class_room,
                success: function(response) {
                    students = response
                    output = false;
                    if (Object.keys(students).length < 1) {
                        $("#table_data").html(
                            "<tr><td rowspan='3'><h5 class='text-success'><i class='fa fa-trash'></i> All the students are paid.</h5></td></tr>"
                        )
                        $("#submit").hide()
                        return false;
                    }
                    students.forEach(student => {
                        if (student.fee_balance > 0) {
                            output = true;
                            tr = document.createElement('tr')
                            tr.id = student.id
                            tr.innerHTML = `
                                <td>${student.id}</td>
                                <td>${student.fullname}</td>
                                <td>${student.fee_balance}</td>
                                <td>${student.fee_amount}</td>
                                <td>
                                    <input hidden value="${student.id}" name="students[]"/>
                                    <input class="form-control" value="0" type="number"  max="${student.fee_amount}" name="paid_amounts[]" value="0"></td>
                        `
                            table.row.add(tr).draw();
                        }
                    });

                    $("#submit").show()

                    if (!output) {
                        $("#table_data").html(
                            "<tr><td rowspan='3'><h5 class='text-success'><i class='fa fa-trash'></i> All the students are paid.</h5></td></tr>"
                        )
                        $("#submit").hide()
                        return false;
                    }

                },
            });
        }
    </script>
@endsection
