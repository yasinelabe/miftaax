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
                    <h4 class="modal-title" id="myModalLabel">Edit Rack</h4>
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
                    <p>Are you sure you want to delete this Rack?</p>
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
                        <h2><a href="/racks/create" class="btn btn-sm btn-success"><i class="fa fa-plus text-white"></i>
                                Rack</a></h2>
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

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-buttons"
                                        class="table jambo_table  table-striped  table-bordered dataTable no-footer dtr-inline"
                                        style="width: 100%;" role="grid" aria-describedby="datatable-buttons_info">
                                        <thead>
                                            <tr role="row">
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Total rows</th>
                                                <th>Total columns</th>
                                                <th>Total shelves</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($racks as $rack)
                                                <tr role="row" class="odd">
                                                    <td>{{ $rack->id }}</td>
                                                    <td>{{ $rack->name }}</td>
                                                    <td>{{ $rack->total_rows }}</td>
                                                    <td>{{ $rack->total_columns }}</td>
                                                    <td>{{ $rack->total_shelves }}</td>
                                                    <td><a href="#" data-toggle="modal"
                                                            data-target=".bs-example-modal-lg"
                                                            onclick="initializeIframe('{{ route('racks.edit', $rack->id) }}')"><i
                                                                class="fa fa-pencil"></i> Edit </a> | <a
                                                            href="javascript:void(0)" data-toggle="modal"
                                                            data-target="#warningModal"
                                                            onclick="delete_id({{ $rack->id }})"><i
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
            document.getElementById("delete").action = "/racks/" + id + "/delete";
        }

        function initializeIframe(url) {
            var iframe = document.getElementById("iframe");
            iframe.src = url;
        }
    </script>
@endsection