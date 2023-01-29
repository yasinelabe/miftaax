@extends('layout.header')
@section('content')
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit Role</h4>
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
    <div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" method="get" id="delete">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this role?</p>
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
                        <h2>Roles <a href="/roles/create" class="btn btn-sm btn-success">New Role</a></h2>
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
                                    <p id="alert" class="alert alert-success text-white  alert-dismissible" role="alert">
                                        {{ Session::get('message') }}</p>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-buttons"
                                        class="table table-striped table-bordered dataTable no-footer dtr-inline"
                                        style="width: 100%;" role="grid" aria-describedby="datatable-buttons_info">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            @foreach ($roles as $role)
                                                <tr>
                                                    <td>{{ $role->role_name }}</td>
                                                    <td>{{ $role->created_at }}</td>
                                                    <td>{{ $role->updated_at }}</td>
                                                    <td>
                                                        @if ($role->id != 1)
                                                            <a data-toggle="modal" data-target=".bs-example-modal-lg"
                                                                class="btn btn-sm btn-success text-white" onclick="initializeIframe({{$role->id}})" >Edit</a>
                                                            <a href="#" data-toggle="modal" data-target="#warningModal" onclick="deleteRole({{$role->id}})"
                                                                class="btn btn-sm btn-danger">Delete</a>
                                                            <a href="/role_menus/{{ $role->id }}"
                                                                class="btn btn-sm btn-success">Menu Permissions</a>
                                                            <a href="/feature_permissions/{{ $role->id }}"
                                                                class="btn btn-sm btn-success">Feature Permissions</a>
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
        function initializeIframe(roleId){
            var iframe = document.getElementById('iframe');
            iframe.src = '/roles/' + roleId + '/edit';
        }

        function deleteRole(roleId){
            var form = document.getElementById('delete');
            form.action = '/roles/' + roleId + '/delete';
        }
    </script>
@endsection
