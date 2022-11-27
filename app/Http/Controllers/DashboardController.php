<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountTransaction;
use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_permission');
    }

    public function dashboard()
    {
        $total_users = User::count();
        $total_students = Student::count();
        $total_teachers = Teacher::count();
        $total_classes = ClassRoom::count();
        $service_income_account = Account::find(13);

        $service_income_account_transactions = AccountTransaction::where('account_id', '=', $service_income_account->id)->where('transaction_date', '>=', date('Y-m-d'))->get();

   
        $service_income = 0;
        foreach ($service_income_account_transactions as $service_income_account_transaction) {
            // if transaction type is 1 then it is debit
            if ($service_income_account_transaction->account_transaction_type_id == 2) {
                $service_income += $service_income_account_transaction->amount;
            }
        }


        // get total today's total expense
        // products expense accounts type = 3

        $all_expense_accounts = Account::where('account_type_id', '=', 3)->get();
        $expense = 0;

        foreach ($all_expense_accounts as $expense_account) {
            if($expense_account->id == 12){
                continue;
            }
            $expense_account_transactions = AccountTransaction::where('account_id', '=', $expense_account->id)->where('transaction_date', '>=', date('Y-m-d'))->get();
            foreach ($expense_account_transactions as $expense_account_transaction) {
                // if transaction type is 1 then it is debit
                if ($expense_account_transaction->account_transaction_type_id == 1) {
                    $expense += $expense_account_transaction->amount;
                }
            }
        }


        // get today's total transactions
        $total_transactions = $service_income_account_transactions->count();

        $total_income = Account::where('account_type_id', 4)->sum('balance');
        $total_expense = Account::where('account_type_id', 3)->sum('balance');
        $total_net_income = $total_income - $total_expense;

        $equity = Account::find(10);
        $equity_balance = $equity->balance;

        return view('dashboard.dashboard', compact('total_users','total_income','total_expense','total_students','total_teachers','total_classes', 'service_income', 'expense','total_transactions','equity_balance','total_net_income'));
    }
}
