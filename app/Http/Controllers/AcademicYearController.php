<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicYear;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AcademicYearController extends Controller
{
    public function index()
    {
        $academic_years = AcademicYear::all();
        $list = true;
        return view('academic_years.index', compact('academic_years', 'list'));
    }


    public function update(Request $request, AcademicYear  $academicyear)
    {
        $this->validate($request, ['is_active' => 'required']);
        DB::table('academic_years')->update(['is_active' => 0]);
        $academicyear->is_active = $request->is_active;
        $academicyear->save();

        $activeYear = $request->session()->get('ActiveYear');
        if (!$activeYear) {
            if ($request->is_active == 1) {
                $request->session()->forget('ActiveYear');
                $request->session()->put('ActiveYear', $academicyear->id);
            }
        }

        return response()->json(['result' => 'success']);
    }

    public function get_year_classes(AcademicYear $academicyear)
    {
        $class_rooms = $academicyear->class_rooms;

        return response()->json(
            $class_rooms
        );
    }
}
