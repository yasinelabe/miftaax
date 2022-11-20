@extends('layout.header')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
            </div>
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Change Password</a></h2>
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
                                        {{ Session::get('message') }}</p>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('users.update_password') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @elseif (session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label for="oldPasswordInput" class="form-label">Old Password</label>
                                    <input name="old_password" type="password"
                                        class="form-control @error('old_password') is-invalid @enderror"
                                        id="oldPasswordInput" placeholder="Old Password">
                                    @error('old_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="newPasswordInput" class="form-label">New Password</label>
                                    <input name="new_password" type="password"
                                        class="form-control @error('new_password') is-invalid @enderror"
                                        id="newPasswordInput" placeholder="New Password">
                                    @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
                                    <input name="new_password_confirmation" type="password" class="form-control"
                                        id="confirmNewPasswordInput" placeholder="Confirm New Password">
                                </div>

                            </div>

                            <div class="card-footer">
                                <button class="btn btn-success">Submit</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        </div>
    @endsection
