<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'fullname',
        'tell',
        'family_link'
    ];


    public function children(){
        return $this->hasMany(Student::class,'guardian_id');
    }
}
