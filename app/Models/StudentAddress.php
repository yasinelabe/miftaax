<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAddress extends Model
{
    use HasFactory;
    public $timestamps = false;


    protected $fillable = [
        'area'
    ];



    public function students(){
        return $this->hasMany(Student::class,'student_address_id');
    }

}
