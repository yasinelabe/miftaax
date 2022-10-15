<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    use HasFactory;
    public $timestamps = false;


    public function accounts(){
        return $this->hasMany(Account::class,'account_type_id');
    }

    protected $fillable = [
        "name",
    ];
}