<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFeeTransaction extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'description',
        'transaction_type',
        'amount',
        'fee_balance',
        'transaction_date',
        'student_id',
        'fee_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function fee()
    {
        return $this->belongsTo(Fee::class);
    }
}