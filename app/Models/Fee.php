<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    public $timestamps = false;


    protected $fillable  = [
        "name",
        "month",
        "fee_type_id",
        "academic_year_id"
    ];


    public function academic_year(){
        return $this->belongsTo(AcademicYear::class,'academic_year_id');
    }

    public function fee_type(){
        return $this->belongsTo(FeeType::class);
    }
}