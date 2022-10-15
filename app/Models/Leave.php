<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'apply_date',
        'from_date',
        'to_date',
        'reason',
        'status',
        'approved_by'
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
    
}
