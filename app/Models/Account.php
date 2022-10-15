<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'accounts';

    public function accounttype()
    {
        return $this->belongsTo(AccountType::class, 'account_type_id');
    }

    protected $fillable = [
        'account_type_id',
        'account_name',
        'balance',
        'parent_id',
    ];


    public function debit($amount)
    {
        if ($this->account_type_id == 2 || $this->account_type_id == 4 || $this->account_type_id == 5) {
            $this->balance =  $this->balance - $amount;
            $this->save();
        } else {
            $this->balance =  $this->balance + $amount;
            $this->save();
        }
    }

    public function credit($amount)
    {
        if ($this->account_type_id == 2 || $this->account_type_id == 4 || $this->account_type_id == 5) {
            $this->balance =  $this->balance + $amount;
            $this->save();
        } else {
            $this->balance =  $this->balance - $amount;
            $this->save();
        }
    }

    public function transfer($amount, $account)
    {
        $this->balance -= $amount;
        $account->balance += $amount;
        $this->save();
        $account->save();
    }
}
