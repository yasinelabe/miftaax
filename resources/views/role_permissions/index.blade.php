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
                            <h2>Role Permissions</h2>
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
                            <form action="/role_permissions/{{ $role->id }}/store" method="post"
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

                                {{-- rolel_id hidden input --}}
                                <input type="hidden" name="role_id" value="{{ $role->id }}">

                                {{-- table --}}

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Asset</th>
                                            <th>Permissions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        {{-- loop through assets --}}
                                        @foreach ($assets as $asset)
                                            <tr>
                                                <td>
                                                    {{ $asset->assets_name }}
                                                    <input name="assets[]" type="hidden" value="{{ $asset->id }}">
                                                </td>
                                                <td>
                                                    {{-- loop through operations and check if current role has permissions in this operation --}}
                                                    @foreach ($operations as $operation)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="{{ $asset->id }}_operations[]"
                                                                value="{{ $operation->id }}"
                                                                @if ($role->hasPermission($asset->id, $operation->id)) checked @endif>
                                                            <label class="form-check-label" for="defaultCheck1">
                                                                {{ $operation->operation_name }}
                                                            </label>
                                                        </div>
                                                    @endforeach


                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

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
