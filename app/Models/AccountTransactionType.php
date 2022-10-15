<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountTransactionType extends Model
{
    use HasFactory;
    public $timestamps = false;

    public $table = 'account_transaction_types';

    public function account_transactions(){
        return $this->hasMany(AccountTransaction::class,'account_transaction_type_id');
    }

    protected $fillable = [
        'name',
    ];

    
}
