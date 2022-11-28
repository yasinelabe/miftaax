@extends('layout.header')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <!-- top tiles -->
        <div class="row tile_count">

            <div class="col-sm-2  tile_stats_count">
                <span class="count_top"><i class="fa fa-users"></i> Total Students</span>
                <div class="count">{{ $total_students }}</div>
            </div>
            <div class="col-sm-2  tile_stats_count">
                <span class="count_top"><i class="fa fa-users"></i> Total Teachers</span>
                <div class="count">{{ $total_teachers }}</div>
            </div>

            <div class="col-sm-2  tile_stats_count">
                <span class="count_top"><i class="fa fa-building"></i> Total Classes</span>
                <div class="count">{{ $total_classes }}</div>
            </div>

            <div class="col-sm-2  tile_stats_count">
                <span class="count_top"><i class="fa fa-dollar"></i> <span class="blue"> {{date('F') }}</span> Total Income</span>
                <div class="count">${{ $total_income }}</div>
                <span class="count_bottom"> </span>
            </div>
            <div class="col-sm-2  tile_stats_count">
                <span class="count_top"><i class="fa fa-dollar"></i> <span class="blue"> {{date('F') }}</span> Total Expense</span>
                <div class="count">${{ $total_expense }}</div>
            </div>
            <div class="col-sm-2  tile_stats_count">
                <span class="count_top"><i class="fa fa-dollar "></i> <span class="blue"> {{date('F') }}</span> Profit</span>
                <div
                    class="count
                     @if ($total_income - $total_expense > 0) green
                        @else 
                        red @endif">
                    ${{ $total_income - $total_expense }}</div>
            </div>
        </div>
        <!-- /top tiles -->
        <input type="hidden" value="{{ $expense_chart }}" id="expense_chart">
        <input type="hidden" value="{{ $income_chart }}" id="income_chart">
        <input type="hidden" value="{{ $invoice_charts }}" id="invoice_charts">
        <input type="hidden" value="{{ $payment_charts }}" id="payment_charts">
        <input type="hidden" value="{{ $overall_income }}" id="total_net_income">
        <input type="hidden" value="{{ $equity_balance }}" id="equity">
        <input type="hidden" value="{{ $male }}" id="male">
        <input type="hidden" value="{{ $female }}" id="female">


        <div class="row">
            <div class="col-sm-3 bg-green">
                <h3>Today's income</h3>
                <h1>${{ $service_income }}</h1>
            </div>
            <div class="col-sm-3 bg-red">
                <h3>Today's expense</h3>
                <h1>$ {{ $expense }}</h1>
            </div>

            <div class="col-sm-3 bg-info text-white">
                <h3>Today's total transactions</h3>
                <h1>{{ $total_transactions }}</h1>
            </div>
            <div class="col-sm-3  bg-warning text-white">
                <h3>Total Unpaid Fees</h3>
                <h1>${{ $total_unpaid_fees }}</h1>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-8  ">
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

        <div class="row">
            <div class="col-sm-8">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Invoices \ Payments</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-4  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Male / Female </small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        @endsection
