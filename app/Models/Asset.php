<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    public $fillable = ['assets_name','route_name'];
    public $timestamps = false;

    public function rolePermissions()
    {
        return $this->hasMany(RolePermission::class);
    }

   
}