@extends('layout.header')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                </div>


            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>New User</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form action="/users/store" method="post" class="form-horizontal form-label-left">
                                @csrf
                                @if (Session::has('success'))
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <p id="alert"
                                                class="alert alert-success text-white  alert-dismissible" role="alert">
                                                {{ Session::get('message') }}</p>
                                        </div>
                                    </div>
                                @endif
                                {{-- display form validation errors --}}
                                @if ($errors->any())
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="category-name">Name
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="name" required="required" class="form-control ">
                                    </div>
                                </div>

                                {{-- username --}}
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="category-name">Username
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="username" required="required" class="form-control ">
                                    </div>
                                </div>

                                {{-- password with comfirmation --}}
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="category-name">Password
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="password" name="password" required="required" class="form-control ">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="category-name">Confirm
                                        Password
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="password" name="password_confirmation" required="required"
                                            class="form-control ">
                                    </div>
                                </div>

                                {{-- Role --}}
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="category-name">Role
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select name="role_id" class="form-control">
                                            <option value="">Select Role</option>
                                            {{-- loop --}}
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="item form-group">
                                    <div class="col-md-6 col-sm-6 offset-md-3">
                                        <button class="btn btn-success" type="reset">Reset</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
