@extends('layout.header')
@section('content')
    <style>
        .top_nav {
            display: none !important;
        }

        .sidebar-menu {
            display: none !important;
        }

        footer {
            display: none !important;
        }

        .right_col {
            background: white !important;
            margin-top: 0 !important;
            height: auto;
        }

    </style>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            <form action="/roles/{{ $role->id }}/update" method="post"
                                class="form-horizontal form-label-left">
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
                                {{-- role_name input --}}
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="role_name">Name
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input value="{{ $role->role_name }}" type="text" id="role_name" name="role_name"
                                            required="required" class="form-control ">
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="item form-group">
                                    <div class="col-sm-4 offset-sm-8">
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
