@extends('layout.header')
@section('content')
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit User</h4>
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
                    <p>Are you sure you want to delete this user?</p>
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
                        <h2>Users <a href="/users/create" class="btn btn-sm btn-success">New User</a></h2>
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
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->username }}</td>
                                                    <td>{{ $user->role_id != null ? $user->role->role_name : '' }}</td>
                                                    <td>{{ $user->created_at }}</td>
                                                    <td>{{ $user->updated_at }}</td>
                                                    <td>
                                                        {{-- if current is this user or admin user don't display delet ebutton --}}
                                                        @if (Auth::user()->id != $user->id && $user->id != 1)
                                                            <a href="#"  data-toggle="modal" data-target=".bs-example-modal-lg"
                                                                class="btn btn-sm btn-success" onclick="initializeIframe({{$user->id}});">Edit</a>
                                                            <a href="#" data-toggle="modal" data-target="#warningModal" onclick="initializeForm({{$user->id}});"
                                                                class="btn btn-sm btn-danger">Delete</a>
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
        function initializeIframe(userId) {
            var iframe = document.getElementById('iframe');
            iframe.src = '/users/' + userId + '/edit';
        }

        function initializeForm(userId) {
            var form = document.getElementById('delete');
            form.action = '/users/' + userId + '/delete';
        }
    </script>
@endsection
