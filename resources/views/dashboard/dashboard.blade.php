@extends('layout.header')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <!-- top tiles -->
        <div class="row tile_count">
                <div class="col-sm-2  tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
                    <div class="count">{{ $total_users }}</div>
                </div>
                <div class="col-sm-2  tile_stats_count">
                    <span class="count_top"><i class="fa fa-clock-o"></i> Total Students</span>
                    <div class="count">{{ $total_students }}</div>
                </div>
                <div class="col-sm-2  tile_stats_count">
                    <span class="count_top"><i class="fa fa-warehouse"></i> Total Teachers</span>
                    <div class="count green">{{ $total_teachers }}</div>
                </div>
                <div class="col-sm-2  tile_stats_count">
                    <span class="count_top"><i class="fa fa-dollar-sign"></i> Total Revenue</span>
                    <div class="count">{{ $total_income }}</div>
                </div>
                <div class="col-sm-2  tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Classes</span>
                    <div class="count">{{ $total_classes }}</div>
                </div>
                <div class="col-sm-2  tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Gross profit</span>
                    <div class="count">{{ $total_income - $total_expense }}</div>
                </div>
        </div>
        <!-- /top tiles -->
        <input type="hidden" value="{{ $total_net_income }}" id="total_net_income">
        <input type="hidden" value="{{ $equity_balance }}" id="equity">


        <div class="row" style="margin: 10px 0;">
            <div class="col-md-3 tile">
                <span>Today's income</span>
                <h2>${{ $service_income }}</h2>
                <span class="sparkline_two" style="height: 160px;">
                    <canvas width="200" height="60"
                        style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                </span>
            </div>
            <div class="col-md-3 tile">
                <span>Today's expense</span>
                <h2>$ {{ $expense }}</h2>
                <span class="sparkline_two" style="height: 160px;">
                    <canvas width="200" height="60"
                        style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                </span>
            </div>

            <div class="col-md-3 tile">
                <span>Today's total transactions</span>
                <h2>{{ $total_transactions }}</h2>
                <span class="sparkline_two" style="height: 160px;">
                    <canvas width="200" height="60"
                        style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                </span>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-8 col-sm-8  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Income vs Expense</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div id="mainb" style="height:350px;"></div>

                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Profit / Loss <small>Percentage graph</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <canvas id="canvasDoughnut"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
