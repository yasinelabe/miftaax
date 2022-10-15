<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'expenses';

    protected $fillable = [
        'expense_category_id',
        'expense_type_id',
        'amount',
        'description',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class,'expense_category_id');
    }

    public function type()
    {
        return $this->belongsTo(ExpenseType::class,'expense_type_id');
    }

    public function scopeOneTimeExpense($query)
    {
        return $query->where('expense_type_id', 1);
    }

    public function scopeWeeklyExpense($query)
    {
        return $query->where('expense_type_id', 2);
    }

    public function scopeMonthlyExpense($query)
    {
        return $query->where('expense_type_id', 3);
    }

}