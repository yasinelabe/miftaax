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
        return $this->hasMany(RoleMenu::class);
    }


    // hasPermission

    /**
     * @param $asset
     * @param $operation
     * @return bool
     */

    public function hasPermission($menu = NULL, $sub_menu = NULL, $low_menu = NULL, $operation)
    {

        if ($menu != NULL) {
            $permission = RoleMenu::where('role_id', $this->id)
                ->where('menu_id', $menu)
                ->where('operation_id', $operation)
                ->first();

            if ($permission) {
                return true;
            }
        }


        if ($sub_menu != NULL) {
            $permission = RoleMenu::where('role_id', $this->id)
                ->where('sub_menu_id', $sub_menu)
                ->where('operation_id', $operation)
                ->first();

            if ($permission) {
                return true;
            }
        }


        if ($low_menu != NULL) {
            $permission = RoleMenu::where('role_id', $this->id)
                ->where('low_menu_id', $low_menu)
                ->where('operation_id', $operation)
                ->first();

            if ($permission) {
                return true;
            }
        }

        return false;
    }
    // hasPermission

    /**
     * @param $asset
     * @param $operation
     * @return bool
     */

    public function hasFeaturePermission($feature, $operation)
    {

        $permission = FeaturePermission::where('role_id', $this->id)
            ->where('feature_id', $feature)
            ->where('operation_id', $operation)
            ->first();

        if ($permission) {
            return true;
        }

        return false;
    }
}
