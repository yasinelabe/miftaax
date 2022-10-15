<?php

namespace App\Repositories;

use App\Models\Exam;

class ExamRepository
{

    public function active_exams()
    {
        return Exam::whereHas('academic_year', function ($query) {
            $query->where('is_active', 1);
        })->get();
    }
}