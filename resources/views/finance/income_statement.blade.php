{{-- create balance sheet view --}}
@extends('layout.header')
@section('title', 'Income statement')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">

            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Income Statement</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th> <select name="year" id="year" class="form-control">
                                                                {{-- loop through years --}}
                                                                @foreach ($years as $year)
                                                                    <option value="{{ $year->year }}">{{ $year->year }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </th>

                                                        <th>
                                                            <select name="month" id="month" class="form-control">
                                                                {{-- loop through months --}}
                                                                @foreach ($months as $month)
                                                                    <option value="{{ $month->month }}">
                                                                        {{ $month->month }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </th>

                                                        <th>
                                                            {{-- get balance sheet --}}
                                                            <button type="button" class="btn btn-success"
                                                                id="get_balance_sheet">Get Income statement</button>
                                                        </th>
                                                    </tr>
                                                </thead>
                                            </table>

                                            {{-- show three cards that will display $totalincome, $total_expense and $total_net_income --}}

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Total Income</h5>
                                                            <h6 class="card-subtitle mb-2 text-muted">Total income</h6>
                                                            <p class="card-text">
                                                            <h2 id="total_income">{{ $total_income }}</h2>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Total Expense</h5>
                                                            <h6 class="card-subtitle mb-2 text-muted">Total expenses</h6>
                                                            <p class="card-text">
                                                            <h2 id="total_expense">{{ $total_expense }}</h2>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card">
                                                        @if ($total_net_income >= 0)
                                                            <div class="card-body bg-success text-white">
                                                                <h5 class="card-title">Profit / Loss</h5>
                                                                <h6 class="card-subtitle mb-2 text-white">Net income</h6>
                                                                <p class="card-text">
                                                                <h2 id="total_net_income">{{ $total_net_income }}</h2>
                                                                </p>
                                                            </div>
                                                        @else
                                                            <div class="card-body bg-danger text-white">
                                                                <h5 class="card-title">Profit / Loss</h5>
                                                                <h6 class="card-subtitle mb-2 text-white">Net income</h6>
                                                                <p class="card-text">
                                                                <h2 id="total_net_income">{{ $total_net_income }}</h2>
                                                                </p>
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
