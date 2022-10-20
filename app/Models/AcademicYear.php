<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'year',
        'is_active'
    ];


    public function class_rooms()
    {
        return $this->hasMany(ClassRoom::class,'academic_year_id');
    }


    public function students(){
        return $this->hasManyThrough(StudentClassRoom::class,ClassRoom::class);
    }

    public function fees(){
        return $this->hasMany(Fee::class);
    }
}