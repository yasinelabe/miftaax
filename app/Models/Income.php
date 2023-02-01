<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    public $table = 'incomes';

    protected $fillable = [
        'income_category_id',
        'income_type_id',
        'amount',
        'description',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(IncomeCategory::class,'income_category_id');
    }

    public function type()
    {
        return $this->belongsTo(IncomeType::class,'income_type_id');
    }

    public function scopeOneTimeincome($query)
    {
        return $query->where('income_type_id', 1);
    }

    public function scopeWeeklyincome($query)
    {
        return $query->where('income_type_id', 2);
    }

    public function scopeMonthlyincome($query)
    {
        return $query->where('income_type_id', 3);
    }
}
