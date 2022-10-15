{{-- create balance sheet view --}}
@extends('layout.header')
@section('title', 'Balance Sheet')
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
                            <h2>Balance Sheet</h2>
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
                                                                id="get_balance_sheet">Get Balance Sheet</button>
                                                        </th>
                                                    </tr>
                                                </thead>
                                            </table>

                                            {{-- show three cards that will display total assets, total liabilities , total equity --}}
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Total Assets</h5>
                                                            {{-- get total balance of assets from the accounts if accounttype is assets --}}
                                                            <h1 id="total_assets">
                                                                {{ $total_assets }}
                                                            </h1>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Total Liabilities</h5>
                                                            {{-- get total balance of liabilities from the accounts if accounttype is liabilities --}}
                                                            <h1 id="total_liabilities">
                                                                {{ $total_liabilities }}
                                                            </h1>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Total Equity</h5>
                                                            {{-- get total balance of equity from the accounts if accounttype is equity --}}
                                                            <h1 id="total_equity">
                                                                {{ $total_equity }}
                                                            </h1>
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
    </div>
@endsection
