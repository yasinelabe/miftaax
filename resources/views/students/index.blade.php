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
                    <h4 class="modal-title" id="myModalLabel">Edit Student</h4>
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
                    <p>Are you sure you want to delete this Student?</p>
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
                    <div class="x_title">
                        <div class="row">
                            <div class="col-2">
                                <h2><a href="/students/create" class="btn btn-sm btn-success"><i
                                            class="fa fa-plus text-white"></i>
                                        Student</a> </h2>
                            </div>

                            <div class="col-3">
                                <form enctype="multipart/form-data" action="{{ route('students.import') }}" method="post"
                                    class="input-group mb-3">
                                    @csrf
                                    <input class="form-control" type="file" name="file">
                                    <div class="input-group-append">
                                        <input type="submit" value="Import" class="btn btn-success">
                                    </div>
                                </form>
                            </div>

                            <div class="col-3">
                                <a class="btn btn-success" href="{{URL::asset('samples/student_template.xlsx')}}" download>Download Sample</a>
                            </div>
                        </div>



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
                                    <div id="alert" class="alert alert-success text-white  alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>{{ Session::get('success') }}</strong>
                        </div>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-buttons"
                                        class="table jambo_table  table-striped  table-bordered dataTable no-footer dtr-inline"
                                        style="width: 100%;" role="grid" aria-describedby="datatable-buttons_info">
                                        <thead>
                                            <tr role="row">
                                                <th>Id</th>
                                                <th>Fullname</th>
                                                <th>Gender</th>
                                                <th>Guardian </th>
                                                <th>Date of birth</th>
                                                <th>Joined date</th>
                                                <th>Address</th>
                                                <th>Has medical emergency</th>
                                                <th>Is active</th>
                                                <th>Is graduated</th>
                                                <th>Fee amount</th>
                                                <th>Fee balance</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $student)
                                                <tr role="row" class="odd">
                                                    <td>{{ $student->id }}</td>
                                                    <td><a
                                                            href="{{ route('students.profile', $student->id) }}">{{ $student->fullname }}</a>
                                                    </td>
                                                    <td>{{ $student->gender }}</td>
                                                    <td>{{ $student->guardian->fullname }}</td>
                                                    <td>{{ $student->date_of_birth }}</td>
                                                    <td>{{ $student->joined_date }}</td>
                                                    <td>{{ $student->student_address->area }}</td>
                                                    @if ($student->has_medical_emergency == 1)
                                                        <td>Yes</td>
                                                    @else
                                                        <td>No</td>
                                                    @endif

                                                    @if ($student->is_active == 1)
                                                        <td>Yes</td>
                                                    @else
                                                        <td>No</td>
                                                    @endif

                                                    @if ($student->is_graduated == 1)
                                                        <td>Yes</td>
                                                    @else
                                                        <td>No</td>
                                                    @endif
                                                    <td>{{ $student->fee_amount }}</td>
                                                    <td>{{ $student->fee_balance }}</td>
                                                    <td><a href="#" data-toggle="modal"
                                                            data-target=".bs-example-modal-lg"
                                                            onclick="initializeIframe('{{ route('students.edit', $student->id) }}')"><i
                                                                class="fa fa-pencil"></i> Edit </a> | <a
                                                            href="javascript:void(0)" data-toggle="modal"
                                                            data-target="#warningModal"
                                                            onclick="delete_id({{ $student->id }})"><i
                                                                class="fa fa-trash-o"></i> Delete </a> </td>
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
            document.getElementById("delete").action = "/students/" + id + "/delete";
        }

        function initializeIframe(url) {
            var iframe = document.getElementById("iframe");
            iframe.src = url;
        }
    </script>
@endsection
