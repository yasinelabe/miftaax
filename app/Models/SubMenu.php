<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    use HasFactory;
    public $timestamps = false;


    function menu(){
        return $this->belongsTo(Menu::class);
    }

    function low_menus(){
        return $this->hasMany(LowMenu::class);
    }
}
