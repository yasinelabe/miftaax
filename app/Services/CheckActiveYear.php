<?php

namespace App\Services;

class CheckActiveYear
{


    public static function check_active_year()
    {
        $activeYear = Session()->get('ActiveYear');
        if (!$activeYear) {
            return redirect()->route('academic_years.create')->withErrors(['error' => 'please create active academic year first.']);
        }

        return $activeYear;
    }
    
}