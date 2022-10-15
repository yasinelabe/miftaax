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
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                </div>


            </div>
            <div class="main_container">
                <div class="col-md-12">
                    <div class="col-middle">
                        <div class="text-center text-center">
                            <h1 class="error-number">203</h1>
                            <h2>Sorrry, you are not authorized to view this page</h2>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
