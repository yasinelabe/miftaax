<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    public $timestamps = false;


    protected $fillable = [
        'plate_number',
        'vehicle_model',
        'year_made',
        'registration_number',
        'chasis_number',
        'max_seating_capacity',
        'driver_name',
        'driver_licence',
        'driver_contact',
        'note',
    ];


    public function routes(){
        return $this->hasManyThrough(Route::class,VihcleRoute::class);
    }

}