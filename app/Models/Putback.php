<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Putback extends Model
{
    use HasFactory;
    public $timestamps = false;
    

    protected $fillable = [
        'taken_book_id',
        'returned_date',
        'note'
    ];


    function takenbook(){
        return $this->belongsTo(TakenBook::class,'taken_book_id');
    }
}
