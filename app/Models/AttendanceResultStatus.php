<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceResultStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'attendance_result_statuses';

    protected $fillable = [
        'name'
    ];
}
