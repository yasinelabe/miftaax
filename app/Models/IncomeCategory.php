<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeCategory extends Model
{
    use HasFactory;
    public $table = 'income_categories';
    
    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public function income()
    {
        return $this->hasMany(Income::class);
    }
}
