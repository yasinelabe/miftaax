<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'fullname',
        'gender',
        'bload_group_id',
        'salary',
        'tell'
    ];

    public function blood_group()
    {
        return $this->belongsTo(BloodGroup::class, 'blood_group_id');
    }
}