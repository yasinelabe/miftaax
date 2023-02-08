<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'book_title' ,
        'cover_image' ,
        'book_category_id' ,
        'book_type_id' ,
        'shelf' ,
        'author_name' ,
        'qty',
        'status' 
    ];


    function book_category(){
        return $this->belongsTo(BookCategory::class,'book_category_id');
    }
    function book_type(){
        return $this->belongsTo(BookType::class,'book_type_id');
    }
}
