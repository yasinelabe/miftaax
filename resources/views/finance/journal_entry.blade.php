{{-- create journal entry form --}}
@extends('layout.header')
@section('title', 'Create Journal Entry')
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
                        <h2>

                            Create Journal Entry

                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                  <div id="success-message"  class="badge alert-success" style="padding:20px;display:none;"></div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-bordered" id="table">
                                            <thead>
                                                <th>Date</th>
                                                <th>Account</th>
                                                <th>Debit</th>
                                                <th>Credit</th>
                                                <th>Description</th>
                                                <th>
                                                    <a class="btn btn-success" onclick="addRow()">
                                                        <i class="text-white fa fa-plus"></i>
                                                    </a>
                                                </th>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="date" name="date" class="form-control"
                                                            value="{{ date('Y-m-d') }}">
                                                    </td>
                                                    <td>
                                                        <select name="account" class="form-control">
                                                            <option value="">Select Account</option>
                                                            @foreach ($accounts as $account)
                                                                <option value="{{ $account->id }}">
                                                                    {{ $account->account_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="debit" class="form-control"
                                                            value="0">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="credit" class="form-control"
                                                            value="0">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="description" class="form-control"
                                                            value="">
                                                    </td>
                                                    <td>
                                                       
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <input type="date" name="date" class="form-control"
                                                            value="{{ date('Y-m-d') }}">
                                                    </td>
                                                    <td>
                                                        <select name="account" class="form-control">
                                                            <option value="">Select Account</option>
                                                            @foreach ($accounts as $account)
                                                                <option value="{{ $account->id }}">
                                                                    {{ $account->account_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="debit" class="form-control"
                                                            value="0">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="credit" class="form-control"
                                                            value="0">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="description" class="form-control"
                                                            value="">
                                                    </td>
                                                    <td>
                                                       
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-success" onclick="Save();" type="submit">Save</button>
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
        function addRow() {
            var table = document.getElementById('table');
            var row = table.insertRow(table.rows.length);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            cell1.innerHTML = '<input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}">';
            cell2.innerHTML = '<select name="account" class="form-control">' +
                '<option value="">Select Account</option>' +
                @foreach ($accounts as $account)
                    '<option value="{{ $account->id }}">{{ $account->account_name }}</option>' +
                @endforeach
            '</select>';
            cell3.innerHTML = '<input type="number" name="debit" class="form-control" value="0">';
            cell4.innerHTML = '<input type="number" name="credit" class="form-control" value="0">';
            cell5.innerHTML = '<input type="text" name="description" class="form-control" value="">';
            cell6.innerHTML = '<a class="btn btn-danger" onclick="deleteRow(this)">' +
                '<i class="fa fa-trash text-white"></i>' +
                '</a>';

        }

        function Save() {
            var table = document.getElementById('table');
            var rows = table.rows.length;
            var data = [];
            for (var i = 1; i < rows; i++) {

                var row = table.rows[i];
                var date = row.cells[0].childNodes[1].value;
                var account = row.cells[1].childNodes[1].value;
                var debit = row.cells[2].childNodes[1].value;
                var credit = row.cells[3].childNodes[1].value;
                var description = row.cells[4].childNodes[1].value;

                if (account == "" || (credit == "" && debit == "")) {
                    alert('Enter some values, please.');
                    return;
                }
                data.push({
                    date: date,
                    account: account,
                    debit: debit,
                    credit: credit,
                    description: description
                });

            }

            // total debit and credit must be equal

            var total_debit = 0;
            var total_credit = 0;

            for (var i = 1; i < rows; i++) {
                var row = table.rows[i];
                var debit = row.cells[2].childNodes[1].value;
                var credit = row.cells[3].childNodes[1].value;
                total_debit += parseInt(debit);
                total_credit += parseInt(credit);
            }

            if (total_debit != total_credit) {
                alert('Total Debit and Credit must be equal');
                return;
            }

            $.ajax({
                type: 'POST',
                url: '{{ route('finance.journal.store') }}',
                data: {
                    data: JSON.stringify(data),
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // display success message
                    document.getElementById('success-message').innerHTML = `
                    <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong> Journal Successfully Added </strong>
                        `;
                    document.getElementById('success-message').style.display = 'block';

                    // set time out for success message
                    setTimeout(function() {
                        document.getElementById('success-message').style.display = 'none';
                    }, 5000);

                    // clear all rows
                    for (var i = 1; i < rows; i++) {
                        var row = table.rows[i];
                        row.cells[0].childNodes[1].value = '';
                        row.cells[1].childNodes[1].value = '';
                        row.cells[2].childNodes[1].value = '';
                        row.cells[3].childNodes[1].value = '';
                        row.cells[4].childNodes[1].value = '';
                    }


                },
                error: function(response) {
                    console.log(response.responseText);
                    alert('Error');
                }
            });

        }


        function deleteRow(r) {
            var i = r.parentNode.parentNode.rowIndex;
            document.getElementById('table').deleteRow(i);
        }
    </script>
@endsection
