<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LowMenu extends Model
{
    use HasFactory;
    public $timestamps = false;


    function sub_menu(){
        return $this->belongsTo(SubMenu::class);
    }
}
