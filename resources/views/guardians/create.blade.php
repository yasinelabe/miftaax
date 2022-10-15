@extends('layout.header')@section('content')<div class="right_col" role="main">
    @if ($iframe)
        <style>
            .top_nav {
                display: none !important;
            }

            .col-md-3.left_col {
                display: none !important;
            }

            .sidebar-menu {
                display: none !important;
            }

            footer {
                display: none !important;
            }

            body {
                background: white !important;
                overflow: auto;
            }

            .right_col {
                background: white !important;
                margin-top: 0 !important;
                height: auto;
            }
        </style>
    @endif
    <div class="container">

        <div class="row">
            <div class="col-md-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content"><br />
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="row">
                                    <div class="col-md-12">
                                        <p id="alert" class="alert alert-danger">
                                            {{ $error }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <form enctype="multipart/form-data" data-parsley-validate
                            class="form-horizontal form-label-left" method="POST"
                            action="{{ route('guardians.store') }}">@csrf<div class="item form-group"><label
                                    class="col-form-label col-md-3 col-sm-3 label-align" for="fullname">Fullname <span
                                        class="required">*</span></label>
                                <div class="col-sm-6"><input type="text" id="fullname" name="fullname"
                                        required="required" class="form-control "></div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="tell">Tell <span class="required">*</span></label>
                                <div class="col-sm-6"><input type="text" id="tell" name="tell"
                                        required="required" class="form-control "></div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="family_link">Family link <span class="required">*</span></label>
                                <div class="col-sm-6"><input type="text" id="family_link" name="family_link"
                                        required="required" class="form-control "></div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-6 offset-3"><button type="submit" class="btn btn-sm btn-success"><i
                                            class="fa fa-save"></i> Save</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>@endsection
