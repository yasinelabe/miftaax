<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountTransaction;
use App\Models\AccountType;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\ExpenseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Finance extends Controller
{

    public function index()
    {
        $accounts = Account::all();
        $account_types = AccountType::all();
        $sub_accounts = Account::where('parent_id', '!=', null);

        return view('finance.index', compact('accounts', 'account_types', 'sub_accounts'));
    }

    public function new_account_form()
    {
        $account_types = AccountType::all();
        return view('finance.new_account', ['account_types' => $account_types]);
    }

    public function store_account(Request $request)
    {
        $request->validate([
            "account_type" => "required",
            "account_name" => "required",
        ]);

        DB::transaction(function () {
            global $request;
            Account::create(
                [
                    "account_type_id" => $request->account_type,
                    "account_name" => $request->account_name,
                    "parent_id" => $request->parent_id,
                    "balance" => 0,
                ]
            );
        });

        Session::flash('message', 'successfully created new account');
        Session::flash('alert-class', 'alert-success');
        return redirect('/finance/accounts');
    }

    public function accounts()
    {
        $accounts = Account::all();
        $account_types = AccountType::all();
        $sub_accounts = Account::where('parent_id', '!=', null)->get();
        return view('finance.accounts', ['accounts' => $accounts, 'types' => $account_types, 'sub_accounts' => $sub_accounts, 'list' => true]);
    }

    public function account_transactions()
    {
        $account_transactions = AccountTransaction::where('account_id', request()->id)->get();
        $account = Account::where('id', request()->id)->first();
        return view('finance.account_transactions', ['transactions' => $account_transactions, 'account' => $account, 'list' => true]);
    }


    public function register_beginning_balance(Request $request)
    {
        DB::transaction(function () {

            global $request;
            // deposit the cash account
            $cash_account = Account::find($request->account_id);
            $cash_account->debit($request->amount);
            $cash_account->save();

            // deposit the equity account
            $equity_account = Account::find(10);
            $equity_account->credit($request->amount);
            $equity_account->save();

            // record cash account transaction
            $account_transaction = new AccountTransaction();
            $account_transaction->account_id = $cash_account->id;
            $account_transaction->amount = $request->amount;
            $account_transaction->balance = $cash_account->balance;
            $account_transaction->account_transaction_type_id = 1;
            $account_transaction->description = 'Beginning Balance';
            $account_transaction->transaction_date = date('Y-m-d');
            $account_transaction->save();

            // record equity account transaction
            $account_transaction = new AccountTransaction();
            $account_transaction->account_id = $equity_account->id;
            $account_transaction->amount = $request->amount;
            $account_transaction->balance = $equity_account->balance;
            $account_transaction->account_transaction_type_id = 2;
            $account_transaction->description = 'Beginning Balance';
            $account_transaction->transaction_date = date('Y-m-d');
            $account_transaction->save();
        });

        Session::flash('success', 'Account Beginning Balance Added Successfully');
        return redirect('/finance/accounts');
    }



    function update_account(Request $request)
    {
        $request->validate([
            "account_name" => "required",
            "account_id" => "required",
        ]);

        $account = Account::find($request->account_id);

        DB::transaction(function () use ($request, $account) {
            global $request;
            $account->account_name = $request->account_name;
            $account->save();
        });

        Session::flash('success', 'Account Updated Successfully');
        return redirect('/finance/accounts');
    }


    function journal_entry_form()
    {
        $accounts = Account::all();
        return view('finance.journal_entry', ['accounts' => $accounts]);
    }


    function store_journal_entry(Request $request)
    {

        DB::transaction(function () {
            global $request;

            // change $request->data into object
            $data = json_decode($request->data);

            foreach ($data as $key => $row) {
                if ($row->debit != 0) {
                    $account = Account::find($row->account);
                    $account->debit($row->debit);
                    $account->save();

                    $account_transaction = new AccountTransaction();
                    $account_transaction->account_id = $account->id;
                    $account_transaction->amount = $row->debit;
                    $account_transaction->balance = $account->balance;
                    $account_transaction->account_transaction_type_id = 1;
                    $account_transaction->description = $row->description;
                    $account_transaction->save();
                }
                if ($row->credit != 0) {
                    $account = Account::find($row->account);
                    $account->credit($row->credit);
                    $account->save();

                    $account_transaction = new AccountTransaction();
                    $account_transaction->account_id = $account->id;
                    $account_transaction->amount = $row->credit;
                    $account_transaction->balance = $account->balance;
                    $account_transaction->account_transaction_type_id = 2;
                    $account_transaction->description = $row->description;
                    $account_transaction->save();
                }
            }
        });
    }


    function balance_sheet()
    {
        $years = AccountTransaction::select(DB::raw('YEAR(transaction_date) as year'))->groupBy('year')->get();
        $months = AccountTransaction::select(DB::raw('MONTH(transaction_date) as month'))->groupBy('month')->get();
        $days = AccountTransaction::select(DB::raw('DAY(transaction_date) as day'))->groupBy('day')->get();

        $total_assets = Account::where('account_type_id', 1)->sum('balance');
        $total_liabilities = Account::where('account_type_id', 2)->sum('balance');
        $total_equity = $total_assets - $total_liabilities;

        return view('finance.balance_sheet', ['years' => $years, 'months' => $months, 'days' => $days, 'total_assets' => $total_assets, 'total_liabilities' => $total_liabilities, 'total_equity' => $total_equity]);
    }


    function income_statement()
    {
        $years = AccountTransaction::select(DB::raw('YEAR(transaction_date) as year'))->groupBy('year')->get();
        $months = AccountTransaction::select(DB::raw('MONTH(transaction_date) as month'))->groupBy('month')->get();

        $total_income = Account::where('account_type_id', 4)->sum('balance');
        $total_expense = Account::where('account_type_id', 3)->sum('balance');


        $total_net_income = $total_income - $total_expense;

        return view('finance.income_statement', ['years' => $years, 'months' => $months, 'total_income' => $total_income, 'total_expense' => $total_expense, 'total_net_income' => $total_net_income]);
    }


    function trial_balance()
    {
        $years = AccountTransaction::select(DB::raw('YEAR(transaction_date) as year'))->groupBy('year')->get();
        $months = AccountTransaction::select(DB::raw('MONTH(transaction_date) as month'))->groupBy('month')->get();

        $account_transactions = AccountTransaction::all();
        $accounts = Account::all();
        return view('finance.trial_balance', ['account_transactions' => $account_transactions, 'accounts' => $accounts, 'years' => $years, 'months' => $months]);
    }


   

    function new_expense()
    {
        $expense_categories = ExpenseCategory::all();
        $expense_types = ExpenseType::all();
        return view('finance.new_expense', compact('expense_categories', 'expense_types'));
    }

    function store_expense(Request $request)
    {
        $request->validate([
            'amount' => "required",
            "description" => "required"
        ]);

        Expense::create($request->all());

        Session::flash('message', 'successfully created new expense');
        Session::flash('alert-class', 'alert-success');
        return redirect('/finance/new_expense');
    }

    function expenses()
    {
        $expenses = Expense::all();
        // cash accounts , where parent_id is in(12) , also the top 3 accounts
        $cash_accounts = Account::whereIn('parent_id',  [1, 2])->orwhereIn('id', [1, 2])->get();
        return view('finance.expenses', ['expenses' => $expenses, 'cash_accounts' => $cash_accounts, 'list' => true]);
    }

    function new_expense_category()
    {
        return view('finance.new_expense_category');
    }

    function store_expense_category(Request $request)
    {
        $request->validate([
            'name' => "required",
        ]);

        ExpenseCategory::create($request->all());

        Session::flash('message', 'successfully created new expense');
        Session::flash('alert-class', 'alert-success');
        return redirect('/finance/new_expense_category');
    }

    function pay_expense(Request $request)
    {
        $request->validate([
            'amount' => "required",
            "description" => "required"
        ]);

        $expense = Expense::find($request->expense_id);
        $expense->status = 'paid';
        $expense->save();

        // deposit the expense account
        $expense_account = Account::find(8);
        $expense_account->debit($request->amount);

        // record the expense transaction
        $expense_transaction = new AccountTransaction();
        $expense_transaction->account_id = $expense_account->id;
        $expense_transaction->amount = $request->amount;
        $expense_transaction->balance = $expense_account->balance;
        $expense_transaction->account_transaction_type_id = 1;
        $expense_transaction->description = $request->description;
        $expense_transaction->save();

        // credit the cash account
        $cash_account = Account::find($request->cash_account_id);
        $cash_account->credit($request->amount);

        // record the cash transaction
        $cash_transaction = new AccountTransaction();
        $cash_transaction->account_id = $cash_account->id;
        $cash_transaction->amount = $request->amount;
        $cash_transaction->balance = $cash_account->balance;
        $cash_transaction->account_transaction_type_id = 2;
        $cash_transaction->description = $request->description;
        $cash_transaction->save();

        Session::flash('message', 'successfully paid expense');
        Session::flash('alert-class', 'alert-success');
        return redirect('/finance/expenses');
    }


}
