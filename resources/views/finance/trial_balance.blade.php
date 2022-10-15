{{-- create trial balance view --}}
@extends('layout.header')
@section('title', 'Trial Balance')
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
                            <h2>Trial Balance</h2>
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
                                                            {{-- get trial balance --}}
                                                            <button type="button" class="btn btn-success"
                                                                id="get_trial_balance">Get Trial Balance</button>
                                                        </th>
                                                    </tr>
                                                </thead>
                                            </table>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Account</th>
                                                                        <th>Debit</th>
                                                                        <th>Credit</th>
                                                                        <th>Balance</th>
                                                                        <th>Transaction Date</th>
                                                                        <th>Description</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="trial_balance">
                                                                    {{-- loop through account_transactions --}}
                                                                    @foreach ($account_transactions as $account_transaction)
                                                                        <tr>
                                                                            <td>{{ $account_transaction->account->account_name }}
                                                                            </td>
                                                                          {{-- if account transaction type is debit show amount else 0 --}}
                                                                            <td>{{ $account_transaction->account_transaction_type->type == 'debit' ? $account_transaction->amount : 0 }}</td>
                                                                            {{-- if account transaction type is credit show amount else 0 --}}
                                                                            <td>{{ $account_transaction->account_transaction_type->type == 'credit' ? $account_transaction->amount : 0 }}</td>
                                                                            
                                                                            <td>{{ $account_transaction->balance }}</td>
                                                                            <td>{{ $account_transaction->transaction_date }}
                                                                            </td>
                                                                            <td>{{ $account_transaction->description }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    {{-- total debit  & total credit --}}
                                                                    <tr>
                                                                        <th>Total</th>
                                                                        <th id="total_debit"></th>
                                                                        <th id="total_credit"></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
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

        <script>
            
            // calculate total debit & total credit
            function calculateTotalDebitCredit() {
                var total_debit = 0;
                var total_credit = 0;
                $('#trial_balance tr').each(function () {
                    var debit = parseFloat($(this).find('td:eq(1)').text());
                    var credit = parseFloat($(this).find('td:eq(2)').text());
                    total_debit += debit;
                    total_credit += credit;
                });
                $('#total_debit').text(total_debit);
                $('#total_credit').text(total_credit);
            }

            calculateTotalDebitCredit();


        </script>
    @endsection
