<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TakenBook extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'taken_books';
    
    protected $fillable = [
        'book_id',
        'qty',
        'library_member_id',
        'taken_date',
        'returning_date'
    ];


    function library_member(){
        return $this->belongsTo(LibraryMember::class,'library_member_id');
    }

    function book(){
        return $this->belongsTo(Book::class,'book_id');
    }
}
