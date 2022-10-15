<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseType extends Model
{
    use HasFactory;

    public $table = 'expense_types';
    
    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public function expense()
    {
        return $this->hasMany(Expense::class);
    }

    
}