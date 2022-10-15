@extends('layout.header') @section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
            </div>
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
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
                                    <div id="alert" class="alert alert-success text-white  alert-dismissible"
                                        role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
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
                                                <th>Year</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($academic_years as $academicyear)
                                                <tr role="row" class="odd">
                                                    <td>{{ $academicyear->id }}</td>
                                                    <td>{{ $academicyear->year }}</td>
                                                    @if ($academicyear->is_active == 1)
                                                        <td><input
                                                                onchange="toggleAcademicYear(this,{{ $academicyear->id }})"
                                                                type="checkbox" class="js-switch" checked /> </td>
                                                    @else
                                                        <td><input
                                                                onchange="toggleAcademicYear(this,{{ $academicyear->id }})"
                                                                type="checkbox" class="js-switch" /> </td>
                                                    @endif
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
    @csrf
    <script>
        function changeSwitch(check, active) {
            if (!check.checked && active) {
                var c = $(check).next('span').attr("class").replace("switchery ", "");
                var l = {
                    "switchery-large": "26px",
                    "switchery-small": "13px",
                    "switchery-default": "20px"
                };
                $(check).prop("checked", true).next('span').attr("style",
                    "box-shadow: rgb(38, 185, 154) 0px 0px 0px 16px inset; border-color: rgb(38, 185, 154); background-color: rgb(38, 185, 154); transition: border 0.4s, box-shadow 0.4s, background-color 1.2s;"
                ).find('small').attr("style", "left: " + l[c] +
                    "; transition: background-color 0.4s, left 0.2s; background-color: rgb(255, 255, 255);");
            } else if (check.checked && !active) {
                $(check).prop("checked", false).next('span').attr("style",
                    "box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"
                ).find('small').attr("style", "left: 0px; transition: background-color 0.4s, left 0.2s;");
            }
        }

        function toggleAcademicYear(target, id) {
            data = {
                id: id,
                is_active: target.checked ? 1 : 0,
                _token: $("input[name='_token']").val()
            }
            $.ajax({
                type: "post",
                data: data,
                url: "/academic_years/" + id + '/update',
                success: function(response) {
                    if (response.result == 'success') {
                        $(".js-switch").each(function(i, element) {
                            if (element !== target) {
                                changeSwitch(element, false)
                            }
                        });
                    }

                }
            });
        }
    </script>
@endsection
