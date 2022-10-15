@extends('layout.header')
@section('content')
    {{-- modal --}}
    <div class="modal fade" id="Bbalance" tabindex="-1" role="dialog" aria-labelledby="BbalanceTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="/finance/register_beginning_balance" method="POST" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Register Beginning Balance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="account_id" id="account_id">
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount">
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="NewAccount" tabindex="-1" role="dialog" aria-labelledby="NewAccountTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="/finance/store_account" method="POST" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="parent_id" id="parent_id">
                    <input type="hidden" name="account_type" id="account_type">
                    <div class="form-group">
                        <label for="account_name">Name</label>
                        <input type="text" class="form-control" id="account_name" name="account_name"
                            placeholder="Account name">
                    </div>

                </div>


                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>

    {{-- edit account modal --}}
    <div class="modal fade" id="editAccountModal" tabindex="-1" role="dialog" aria-labelledby="EditAccountTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="/finance/update_account" method="POST" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="account_id" id="edit_account_id">
                    <div class="form-group">
                        <label for="account_name">Name</label>
                        <input type="text" class="form-control" id="edit_account_name" name="account_name"
                            placeholder="Account name">
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>

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
                        <h2>Chart of accounts


                        </h2>
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
                        @if (Session::has('success'))
                            <div class="row">
                                <div class="col-md-12">
                                    <p id="alert" class="alert {{ Session::get('alert-class', 'alert-success') }}">
                                        {{ Session::get('success') }}</p>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">

                                    @foreach ($types as $type)
                                        <h4 class="account_type">{{ $type->name }}</h4>
                                        <ul class="sub_accounts_ul">
                                            @foreach ($accounts as $account)
                                                @if ($account->account_type_id == $type->id && $account->parent_id == null)
                                                    <li class="sub_accounts"
                                                        onmouseout="hideOptions('options_{{ $account->id }}')"
                                                        onmouseover="showOptions('options_{{ $account->id }}')">
                                                        <span
                                                            class="dp-sides "><a>{{ ucfirst($account->account_name) }}</a>
                                                            <span class="hover_options" id="options_{{ $account->id }}">
                                                                <a href="#"
                                                                    onclick="invokeNewAccountModal({{ $account->id }},{{ $type->id }})"
                                                                    class="new_hover">New</a>
                                                                <a href="#" class="edit_hover"
                                                                    onclick="editAccount({{ $account->id }},'{{ $account->account_name }}')">Edit</a>
                                                                <a href="/finance/account_transactions/{{ $account->id }}"
                                                                    class="ledger_hover">Ledger</a>
                                                            </span>
                                                            <a>{{ $account->balance }}</a></span>
                                                        <ul class="sub_accounts_ul">
                                                            @foreach ($sub_accounts as $sub_account)
                                                                @if ($sub_account->parent_id == $account->id)
                                                                    <li class="sub_accounts"
                                                                        style="margin-top:5px;border-bottom:.3px solid #ccc;"
                                                                        onmouseout="hideOptions('options_{{ $sub_account->id }}')"
                                                                        onmouseover="showOptions('options_{{ $sub_account->id }}')">
                                                                        <span class="dp-sides ">
                                                                            <a>{{ ucfirst($sub_account->account_name) }}</a>
                                                                            <span class="hover_options"
                                                                                id="options_{{ $sub_account->id }}">
                                                                                <a href="#" class="edit_hover"
                                                                                    onclick="editAccount({{ $sub_account->id }},'{{ $sub_account->account_name }}')">Edit</a>
                                                                                <a href="/finance/account_transactions/{{ $sub_account->id }}"
                                                                                    class="ledger_hover">Ledger</a>
                                                                            </span>

                                                                            <a>{{ $sub_account->balance }}</a>
                                                                        </span>
                                                                    </li><br>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </li><br>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function initAccountId(account_id) {
            let account_id_element = document.getElementById('account_id');
            account_id_element.value = account_id;
        }

        function editAccount(account_id, account_name) {
            let account_id_element = document.getElementById('edit_account_id');
            let account_name_element = document.getElementById('edit_account_name');
            account_id_element.value = account_id;
            account_name_element.value = account_name;

            // invoke edit modal
            $('#editAccountModal').modal('show');
        }


        function showOptions(options_id) {
            $("#" + options_id).show()
        }

        function hideOptions(options_id) {
            $("#" + options_id).hide()
        }

        function invokeNewAccountModal(parent_id, type_id) {
            $("#account_type").val(type_id)
            $("#parent_id").val(parent_id)
            $("#NewAccount").modal('show')
        }
    </script>
@endsection
