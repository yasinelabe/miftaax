@extends('layout.header')
@section('content')

{{-- pay income modal --}}
<div class="modal fade" id="comfirmIncomeModal" tabindex="-1" role="dialog" aria-labelledby="comfirmIncomeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('finance.incomes.comfirm') }}" method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="comfirmIncomeModalLabel">Comfirm income</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
               
                    @csrf
                    <input type="hidden" name="income_id" id="income_id">
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
                        <h2>Incomes  <a class="btn btn-sm btn-success" href="/finance/new_income">New</a></h2>
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
                                            @foreach ($incomes as $income)
                                                <tr>
                                                    <td>{{$income->description}}</td>
                                                    <td>{{ $income->category->name }}</td>
                                                    <td>{{ $income->type->name}}</td>
                                                    <td>{{ $income->amount }}</td>
                                                    <td> {{ $income->status }}</td>
                                                    {{-- if status is pending than show the pay button --}}
                                                    @if ($income->status == 'pending')
                                                        <td>
                                                            <a onclick="setValues('{{$income->amount}}','{{$income->id}}');" href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#comfirmIncomeModal" >comfirm</a>
                                                        </td>
                                                    @else
                                                        
                                                        <td>
                                                            <a href="/finance/income/{{$income->id}}"
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
        function setValues(amount,incomeid){
            $('#amount').val(amount);
            $('#amount2').val(amount);
            $('#income_id').val(incomeid);
        }
    </script>

@endsection
