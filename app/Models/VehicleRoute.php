<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleRoute extends Model
{
    use HasFactory;
    public $timestamps = false;



    function vehicles(){
        return $this->belongsTo(Vehicle::class);
    }


    function routes(){
        return $this->belongsTo(Route::class);
    }
}