<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grading extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'from_marks',
        'to_marks',
        'grade',
        'exam_type_id',
        'points'
    ];


    public static function get_grading_id($marks,$max_marks=100): int
    {
        $percent = $marks * 100 / $max_marks;

        $rows = self::all();
        foreach ($rows as $row) {
            if ((int)$percent >= (int)$row->from_marks) {
                if ((int)$percent <= (int)$row->to_marks) {
                    return $row->id;
                };
            };
        }
    }


    public function exam_type(){
        return $this->belongsTo(ExamType::class);
    }


}
