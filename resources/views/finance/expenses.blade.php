@extends('layout.header')
@section('content')

{{-- pay expense modal --}}
<div class="modal fade" id="payExpenseModal" tabindex="-1" role="dialog" aria-labelledby="payExpenseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('finance.expenses.pay') }}" method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="payExpenseModalLabel">Pay Expense</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
               
                    @csrf
                    <input type="hidden" name="expense_id" id="expense_id">
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="hidden" class="form-control" name="amount" id="amount" >
                        <input type="number" class="form-control" id="amount2" disabled>
                    </div>
                    <div class="form-group">
                        <label for="payment_method">Payment Method</label>
                        <select class="form-control" id="payment_method" name="cash_account_id" required>
                            <option value="">Select Payment Method</option>
                            {{-- loop cash accounts --}}
                            @foreach ($cash_accounts as $cashAccount)
                                <option value="{{ $cashAccount->id }}">{{ $cashAccount->account_name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="payment_details">Payment Details</label>
                        <input type="text" required class="form-control" id="payment_details" name="description" placeholder="Payment Details">
                    </div>
                    
            </div>
            <div class="modal-footer">
                <input type="submit" value="Pay" class="btn btn-success">
                <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
            </div>
        </form>
    </div>
</div>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
            </div>
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Expenses  <a class="btn btn-sm btn-success" href="/finance/new_expense">New</a></h2>
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
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-buttons" class="table table-striped table-bordered"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name/Description</th>
                                                <th>Category</th>
                                                <th>Type</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            @foreach ($expenses as $expense)
                                                <tr>
                                                    <td>{{$expense->description}}</td>
                                                    <td>{{ $expense->category->name }}</td>
                                                    <td>{{ $expense->type->name}}</td>
                                                    <td>{{ $expense->amount }}</td>
                                                    <td> {{ $expense->status }}</td>
                                                    {{-- if status is pending than show the pay button --}}
                                                    @if ($expense->status == 'pending')
                                                        <td>
                                                            <a onclick="setValues('{{$expense->amount}}','{{$expense->id}}');" href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#payExpenseModal" >Pay</a>
                                                        </td>
                                                    @else
                                                        
                                                        <td>
                                                            <a href="/finance/expense/{{$expense->id}}"
                                                                class="btn btn-sm btn-success">view</a>
                                                        </td>
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

    <script>
        function setValues(amount,expenseid){
            $('#amount').val(amount);
            $('#amount2').val(amount);
            $('#expense_id').val(expenseid);
        }
    </script>

@endsection
