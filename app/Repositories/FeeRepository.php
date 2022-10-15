<?php

namespace App\Repositories;

use App\Models\Account;
use App\Models\AccountTransaction;
use App\Models\Fee;
use App\Models\Student;
use App\Models\StudentFeeTransaction;

class FeeRepository
{

    public function active_fees()
    {
        return Fee::whereHas('academic_year', function ($query) {
            $query->where('is_active', 1);
        })->get();
    }

    public function save_student_payment($student, $paid_amount, $fee_id, $receiving_account)
    {
        if ($paid_amount > 0) {
            $student = Student::find($student);
            $student->fee_balance = $student->fee_balance - $paid_amount;
            $student->save();


            $fee_transaction = new StudentFeeTransaction();
            $fee_transaction->description = 'Fee Payment ';
            $fee_transaction->transaction_type = 'payment';
            $fee_transaction->amount = $paid_amount;
            $fee_transaction->fee_balance = $student->fee_balance;
            $fee_transaction->transaction_date = date('Y-m-d');
            $fee_transaction->student_id = $student->id;
            $fee_transaction->fee_id = $fee_id;
            $fee_transaction->save();


            // debit the receiving account
            $receiving_account->debit($paid_amount);

            // record the receiving account transaction
            $receiving_account_transaction = new AccountTransaction();
            $receiving_account_transaction->account_id = $receiving_account->id;
            $receiving_account_transaction->amount = $paid_amount;
            $receiving_account_transaction->balance = $receiving_account->balance;
            $receiving_account_transaction->account_transaction_type_id = 1;
            $receiving_account_transaction->description = 'fee paid by, StudentID:  ' . $student->id . ', Full Name: ' . $student->fullname;
            $receiving_account_transaction->save();


            // credit the accounts receivable account
            $accounts_receivable_account = Account::find(12);
            $accounts_receivable_account->credit($paid_amount);

            // record the accounts receivable account transaction
            $accounts_receivable_account_transaction = new AccountTransaction();
            $accounts_receivable_account_transaction->account_id = $accounts_receivable_account->id;
            $accounts_receivable_account_transaction->amount = $paid_amount;
            $accounts_receivable_account_transaction->balance = $accounts_receivable_account->balance;
            $accounts_receivable_account_transaction->account_transaction_type_id = 2;
            $accounts_receivable_account_transaction->description = 'fee paid by, StudentID:  ' . $student->id . ', Full Name: ' . $student->fullname;
            $accounts_receivable_account_transaction->student_id = $student->id;
            $accounts_receivable_account_transaction->save();

            return true;
        } else {
            return false;
        }
    }

    public function generate_student_fee($student, $fee, $description)
    {
        $student->fee_balance = $student->fee_balance + $student->fee_amount;
        $student->save();

        $fee_transaction = new StudentFeeTransaction();
        $fee_transaction->description = $description;
        $fee_transaction->transaction_type = 'invoice';
        $fee_transaction->amount = $student->fee_amount;
        $fee_transaction->fee_balance = $student->fee_balance;
        $fee_transaction->transaction_date = date('Y-m-d');
        $fee_transaction->student_id = $student->id;
        $fee_transaction->fee_id = $fee->id;
        $fee_transaction->save();


        $account = Account::find(12);
        $account->debit($student->fee_amount);
        $account->save();

        $account_transaction = new AccountTransaction();
        $account_transaction->account_id = $account->id;
        $account_transaction->amount = $student->fee_amount;
        $account_transaction->balance = $account->balance;
        $account_transaction->account_transaction_type_id = 1;
        $account_transaction->description = $student->fullname . 'With StudentID: '.$student->id . ' , Fee Invoice';
        $account_transaction->student_id = $student->id;
        $account_transaction->save();


        // credit the revenue account
        $revenue_account = Account::find(13);
        $revenue_account->credit($student->fee_amount);

        // record the transaction
        $revenue_account_transaction = new AccountTransaction();
        $revenue_account_transaction->account_id = $revenue_account->id;
        $revenue_account_transaction->amount = $student->fee_amount;
        $revenue_account_transaction->balance = $revenue_account->balance;
        $revenue_account_transaction->account_transaction_type_id = 2;
        $revenue_account_transaction->description = $student->fullname . 'With StudentID: '.$student->id . ' , Fee Invoice';
        $revenue_account_transaction->save();
    }
}
