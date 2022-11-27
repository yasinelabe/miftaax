<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountTransaction;
use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\StudentFeeTransaction;
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
        $all_income_accounts = Account::where('account_type_id', '=', 4)->get();
        $expense = 0;

        foreach ($all_expense_accounts as $expense_account) {
            if($expense_account->id == 11){
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


        $expense_ids = $all_expense_accounts->map(function($account){
            if($account->id != 11){
                return $account->id;
            }
        })->filter(function($account){ 
            return $account != NULL;
        })->toArray();

        $income_ids = $all_income_accounts->map(function($account){
            return $account->id;
        })->toArray();


        $jan_income = AccountTransaction::where('account_transaction_type_id',2)->whereIn('account_id',$income_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '1')->sum('amount');
        $feb_income = AccountTransaction::where('account_transaction_type_id',2)->whereIn('account_id',$income_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '2')->sum('amount');
        $mar_income = AccountTransaction::where('account_transaction_type_id',2)->whereIn('account_id',$income_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '3')->sum('amount');
        $apr_income = AccountTransaction::where('account_transaction_type_id',2)->whereIn('account_id',$income_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '4')->sum('amount');
        $may_income = AccountTransaction::where('account_transaction_type_id',2)->whereIn('account_id',$income_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '5')->sum('amount');
        $jun_income = AccountTransaction::where('account_transaction_type_id',2)->whereIn('account_id',$income_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '6')->sum('amount');
        $jul_income = AccountTransaction::where('account_transaction_type_id',2)->whereIn('account_id',$income_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '7')->sum('amount');
        $aug_income = AccountTransaction::where('account_transaction_type_id',2)->whereIn('account_id',$income_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '8')->sum('amount');
        $sep_income = AccountTransaction::where('account_transaction_type_id',2)->whereIn('account_id',$income_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '9')->sum('amount');
        $oct_income = AccountTransaction::where('account_transaction_type_id',2)->whereIn('account_id',$income_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '10')->sum('amount');
        $nov_income = AccountTransaction::where('account_transaction_type_id',2)->whereIn('account_id',$income_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '11')->sum('amount');
        $dec_income = AccountTransaction::where('account_transaction_type_id',2)->whereIn('account_id',$income_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '12')->sum('amount');

        $jan_expense = AccountTransaction::where('account_transaction_type_id',1)->whereIn('account_id',$expense_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '1')->sum('amount');
        $feb_expense = AccountTransaction::where('account_transaction_type_id',1)->whereIn('account_id',$expense_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '2')->sum('amount');
        $mar_expense = AccountTransaction::where('account_transaction_type_id',1)->whereIn('account_id',$expense_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '3')->sum('amount');
        $apr_expense = AccountTransaction::where('account_transaction_type_id',1)->whereIn('account_id',$expense_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '4')->sum('amount');
        $may_expense = AccountTransaction::where('account_transaction_type_id',1)->whereIn('account_id',$expense_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '5')->sum('amount');
        $jun_expense = AccountTransaction::where('account_transaction_type_id',1)->whereIn('account_id',$expense_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '6')->sum('amount');
        $jul_expense = AccountTransaction::where('account_transaction_type_id',1)->whereIn('account_id',$expense_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '7')->sum('amount');
        $aug_expense = AccountTransaction::where('account_transaction_type_id',1)->whereIn('account_id',$expense_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '8')->sum('amount');
        $sep_expense = AccountTransaction::where('account_transaction_type_id',1)->whereIn('account_id',$expense_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '9')->sum('amount');
        $oct_expense = AccountTransaction::where('account_transaction_type_id',1)->whereIn('account_id',$expense_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '10')->sum('amount');
        $nov_expense = AccountTransaction::where('account_transaction_type_id',1)->whereIn('account_id',$expense_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '11')->sum('amount');
        $dec_expense = AccountTransaction::where('account_transaction_type_id',1)->whereIn('account_id',$expense_ids)->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date', '=', '12')->sum('amount');


        $income_chart = json_encode([
            $jan_income,
            $feb_income,
            $mar_income,
            $apr_income,
            $may_income,
            $jun_income,
            $jul_income,
            $aug_income,
            $sep_income,
            $oct_income,
            $nov_income,
            $dec_income
        ]);

        $expense_chart = json_encode([
            $jan_expense,
            $feb_expense,
            $mar_expense,
            $apr_expense,
            $may_expense,
            $jun_expense,
            $jul_expense,
            $aug_expense,
            $sep_expense,
            $oct_expense,
            $nov_expense,
            $dec_expense
        ]);



        $jan_invoices = StudentFeeTransaction::where(['transaction_type'=>'invoice'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','1')->sum('amount');
        $feb_invoices = StudentFeeTransaction::where(['transaction_type'=>'invoice'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','2')->sum('amount');
        $mar_invoices = StudentFeeTransaction::where(['transaction_type'=>'invoice'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','3')->sum('amount');
        $apr_invoices = StudentFeeTransaction::where(['transaction_type'=>'invoice'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','4')->sum('amount');
        $may_invoices = StudentFeeTransaction::where(['transaction_type'=>'invoice'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','5')->sum('amount');
        $jun_invoices = StudentFeeTransaction::where(['transaction_type'=>'invoice'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','6')->sum('amount');
        $jul_invoices = StudentFeeTransaction::where(['transaction_type'=>'invoice'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','7')->sum('amount');
        $aug_invoices = StudentFeeTransaction::where(['transaction_type'=>'invoice'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','8')->sum('amount');
        $sep_invoices = StudentFeeTransaction::where(['transaction_type'=>'invoice'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','9')->sum('amount');
        $oct_invoices = StudentFeeTransaction::where(['transaction_type'=>'invoice'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','10')->sum('amount');
        $nov_invoices = StudentFeeTransaction::where(['transaction_type'=>'invoice'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','11')->sum('amount');
        $dec_invoices = StudentFeeTransaction::where(['transaction_type'=>'invoice'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','12')->sum('amount');

        $jan_payments = StudentFeeTransaction::where(['transaction_type'=>'payment'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','1')->sum('amount');
        $feb_payments = StudentFeeTransaction::where(['transaction_type'=>'payment'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','2')->sum('amount');
        $mar_payments = StudentFeeTransaction::where(['transaction_type'=>'payment'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','3')->sum('amount');
        $apr_payments = StudentFeeTransaction::where(['transaction_type'=>'payment'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','4')->sum('amount');
        $may_payments = StudentFeeTransaction::where(['transaction_type'=>'payment'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','5')->sum('amount');
        $jun_payments = StudentFeeTransaction::where(['transaction_type'=>'payment'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','6')->sum('amount');
        $jul_payments = StudentFeeTransaction::where(['transaction_type'=>'payment'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','7')->sum('amount');
        $aug_payments = StudentFeeTransaction::where(['transaction_type'=>'payment'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','8')->sum('amount');
        $sep_payments = StudentFeeTransaction::where(['transaction_type'=>'payment'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','9')->sum('amount');
        $oct_payments = StudentFeeTransaction::where(['transaction_type'=>'payment'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','10')->sum('amount');
        $nov_payments = StudentFeeTransaction::where(['transaction_type'=>'payment'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','11')->sum('amount');
        $dec_payments = StudentFeeTransaction::where(['transaction_type'=>'payment'])->whereYear('transaction_date','=',date('Y'))->whereMonth('transaction_date','=','12')->sum('amount');


        $payment_charts = json_encode([
            $jan_payments,
            $feb_payments,
            $mar_payments,
            $apr_payments,
            $may_payments,
            $jun_payments,
            $jul_payments,
            $aug_payments,
            $sep_payments,
            $oct_payments,
            $nov_payments,
            $dec_payments
        ]);

        $invoice_charts = json_encode([
            $jan_invoices,
            $feb_invoices,
            $mar_invoices,
            $apr_invoices,
            $may_invoices,
            $jun_invoices,
            $jul_invoices,
            $aug_invoices,
            $sep_invoices,
            $oct_invoices,
            $nov_invoices,
            $dec_invoices
        ]);

        return view('dashboard.dashboard', compact('total_users','total_income','total_expense','total_students','total_teachers','total_classes', 'service_income', 'expense','total_transactions','equity_balance','total_net_income','income_chart','expense_chart','invoice_charts','payment_charts'));
    }
}
