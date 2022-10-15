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
                    <h4 class="modal-title" id="myModalLabel">Edit Leave</h4>
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
                    <p>Are you sure you want to delete this Leave?</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-danger" id="delete">Delete</button>
                </div>
            </form>
        </div>
    </div>
    {{-- warning modal before delete --}}
    <div class="modal fade" id="approvemodal" tabindex="-3" role="dialog" aria-labelledby="approvemodal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" method="get" id="approve">
                <div class="modal-header">
                    <h5 class="modal-title">Approve</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to Approve this Leave?</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-success" id="delete">Approve</button>
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
                        <h2><a href="/leaves/create" class="btn btn-sm btn-success"><i class="fa fa-plus text-white"></i>
                                Leave</a></h2>
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
                                                <th>StudentID</th>
                                                <th>Student Name </th>
                                                <th>Apply date</th>
                                                <th>From date</th>
                                                <th>To date</th>
                                                <th>Reason</th>
                                                <th>Status</th>
                                                <th>Approved by</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($leaves as $leave)
                                                <tr role="row" class="odd">
                                                    <td>{{ $leave->id }}</td>
                                                    <td>{{ $leave->student->id }}</td>
                                                    <td>{{ $leave->student->fullname }}</td>
                                                    <td>{{ $leave->apply_date }}</td>
                                                    <td>{{ $leave->from_date }}</td>
                                                    <td>{{ $leave->to_date }}</td>
                                                    <td>{{ $leave->reason }}</td>
                                                    <td>{{ $leave->status }}</td>
                                                    <td>

                                                        @if ($leave->approved_by != '')
                                                            @foreach ($users as $user)
                                                                    @if ($user->id == $leave->approved_by)
                                                                        {{ $user->name }}
                                                                    @endif
                                                            @endforeach
                                                        @endif

                                                    </td>
                                                    <td><a href="#" data-toggle="modal"
                                                            data-target=".bs-example-modal-lg"
                                                            onclick="initializeIframe('{{ route('leaves.edit', $leave->id) }}')"><i
                                                                class="fa fa-pencil"></i> Edit </a> | <a
                                                            href="javascript:void(0)" data-toggle="modal"
                                                            data-target="#warningModal"
                                                            onclick="delete_id({{ $leave->id }})"><i
                                                                class="fa fa-trash-o"></i> Delete </a>
                                                        @if ($leave->status == 'pending')
                                                            | <a href="javascript:void(0)" data-toggle="modal"
                                                                data-target="#approvemodal"
                                                                onclick="approve_leave({{ $leave->id }})"><i
                                                                    class="fa fa-check"></i> Approve </a>
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
            document.getElementById("delete").action = "/leaves/" + id + "/delete";
        }

        function approve_leave(id) {
            document.getElementById("approve").action = "/leaves/" + id + "/approve";
        }

        function initializeIframe(url) {
            var iframe = document.getElementById("iframe");
            iframe.src = url;
        }
    </script>
@endsection
