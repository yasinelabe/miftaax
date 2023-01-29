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
                            <form action="/role_menus/{{ $role->id }}/store" method="post"
                                class="form-horizontal form-label-left">
                                @csrf


                                @if (Session::has('success'))
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <p id="alert" class="alert alert-success text-white  alert-dismissible"
                                                role="alert">
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
                                            <th>Menus</th>
                                            <th>Permissions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        {{-- loop through assets --}}
                                        @foreach ($menus as $menu)
                                            <tr class="menu_tr">
                                                <td>
                                                    {{ $menu->name }}
                                                    <input name="menus[]" type="hidden" value="{{ $menu->id }}">
                                                </td>
                                                <td>
                                                    {{-- loop through operations and check if current role has permissions in this operation --}}
                                                    @foreach ($operations as $operation)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="menu_{{ $menu->id }}_operations[]"
                                                                value="{{ $operation->id }}"
                                                                @if ($role->hasPermission($menu->id, null, null, $operation->id)) checked @endif>
                                                            <label class="form-check-label" for="defaultCheck1">
                                                                {{ $operation->operation_name }}
                                                            </label>
                                                        </div>
                                                    @endforeach


                                                </td>
                                                @foreach ($menu->sub_menus as $sub_menu)
                                            <tr class="sub_menu_tr">
                                                <td>
                                                    {{ $sub_menu->name }}
                                                    <input name="sub_menus[]" type="hidden" value="{{ $sub_menu->id }}">
                                                </td>
                                                <td>
                                                    {{-- loop through operations and check if current role has permissions in this operation --}}
                                                    @foreach ($operations as $operation)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="sub_menu_{{ $sub_menu->id }}_operations[]"
                                                                value="{{ $operation->id }}"
                                                                @if ($role->hasPermission(null,$sub_menu->id, null, $operation->id)) checked @endif>
                                                            <label class="form-check-label" for="defaultCheck1">
                                                                {{ $operation->operation_name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </td>
                                            </tr>

                                            @if ($sub_menu->has_low_menu)
                                                @foreach ($sub_menu->low_menus as $low_menu)
                                                    <tr class="low_menu_tr">
                                                        <td>
                                                            {{ $low_menu->name }}
                                                            <input name="low_menus[]" type="hidden"
                                                                value="{{ $low_menu->id }}">
                                                        </td>
                                                        <td>
                                                            {{-- loop through operations and check if current role has permissions in this operation --}}
                                                            @foreach ($operations as $operation)
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="low_menu_{{ $low_menu->id }}_operations[]"
                                                                        value="{{ $operation->id }}"
                                                                        @if ($role->hasPermission(null,null,$low_menu->id, $operation->id)) checked @endif>
                                                                    <label class="form-check-label" for="defaultCheck1">
                                                                        {{ $operation->operation_name }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="ln_solid"></div>
                                <div class="item form-group">
                                    <div class="col-8">
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
