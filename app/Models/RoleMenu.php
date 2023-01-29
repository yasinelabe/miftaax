<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'role_menu';

    public $fillable = ['role_id', 'menu_id','sub_menu_id','low_menu_id','operation_id'];

    // relationships

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function menus()
    {
        return $this->belongsTo(Menu::class);
    }

    public function sub_menus(){
        return $this->belongsTo(SubMenu::class);
    }

    public function low_menus(){
        return $this->belongsTo(LowMenu::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function operation()
    {
        return $this->belongsTo(Operation::class);
    }


}