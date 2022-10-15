<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    
    public $fillable = ['role_name'];
    public $timestamps = false;

    // relationships

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function rolePermissions()
    {
        return $this->hasMany(RolePermission::class);
    }


    // hasPermission

    /**
     * @param $asset
     * @param $operation
     * @return bool
     */

    public function hasPermission($asset, $operation)
    {
        $permission = RolePermission::where('role_id', $this->id)
            ->where('asset_id', $asset)
            ->where('operation_id', $operation)
            ->first();

        if ($permission) {
            return true;
        }

        return false;
    }

}