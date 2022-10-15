<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountTransaction extends Model
{
    use HasFactory;
    public $timestamps = false;

    public $table = 'account_transactions';

    public function account(){
        return $this->belongsTo(Account::class,'account_id');
    }


    public function account_transaction_type(){
        return $this->belongsTo(AccountTransactionType::class,'account_transaction_type_id');
    }

    protected $fillable = [
        'account_id',
        'account_transaction_type_id',
        'amount',
        'balance',
        'description',
        'transaction_date'
    ];

}