@extends('layout.header')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                </div>


            </div>
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{ $account->account_name }} account ledger </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (Session::has('deleted'))
                            <div class="row">
                                <div class="col-md-12">
                                    <p id="alert" class="alert {{ Session::get('alert-class', 'alert-success') }}">
                                        {{ Session::get('deleted') }}</p>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-buttons" class="table table-striped table-bordered"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>debit</th>
                                                <th>credit</th>
                                                <th>balance</th>
                                                <th>date</th>
                                                <th>Description</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($transactions as $transaction)
                                                <tr>
                                                    <td>{{ $transaction->id }}</td>
                                                    <td>
                                                        @if ($transaction->account_transaction_type->type == 'debit')
                                                            {{ $transaction->amount }}
                                                        @else
                                                            0
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($transaction->account_transaction_type->type == 'credit')
                                                            {{ $transaction->amount }}
                                                        @else
                                                            0
                                                        @endif
                                                    </td>
                                                    <td>{{ $transaction->balance }}</td>
                                                    <td>{{ $transaction->transaction_date }}</td>
                                                    <td>{{ 
                                                        $transaction->description }}</td>
                                                    </td>
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

@endsection
