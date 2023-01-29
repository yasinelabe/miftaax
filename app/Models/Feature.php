<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    public $fillable = ['feature_name','route_name'];
    public $timestamps = false;

    public function role_menus()
    {
        return $this->hasMany(RoleMenu::class);
    }

   
}