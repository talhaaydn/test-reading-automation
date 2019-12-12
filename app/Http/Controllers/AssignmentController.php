<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Assignment;
use App\Models\Department;
use App\Models\Classes;
use App\Models\YearTerm;
use App\Models\Course;
use App\User;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departments = DB::table('departments')
                ->join('user_course_assign', 'departments.id', '=', 'user_course_assign.department_id')
                ->select('departments.*')
                ->distinct()
                ->get();

        $classes = DB::table('classes')
            ->join('user_course_assign', 'classes.id', '=', 'user_course_assign.class_id')
            ->select('classes.*')
            ->distinct()
            ->get();

        $yearTerms = YearTerm::all();

        if($request->department_id != null && $request->class_id != null && $request->year_term_id != null){
            $assignments = Assignment::where([
                ['department_id', $request->department_id],
                ['class_id', $request->class_id],
                ['year_term_id', $request->year_term_id]
            ])->get();

        } else {
            $assignments = Assignment::all();
        }       

        return view('assignment.index', compact('assignments', 'departments', 'classes', 'yearTerms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $classes = Classes::all();
        $yearTerms = YearTerm::all();
        $courses = Course::all();
        $users = User::where('role_id', 2)->get();

        return view('assignment.create', compact('departments', 'classes', 'yearTerms', 'courses', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'department_id' => 'required',
                'class_id'      => 'required',
                'year_term_id'  => 'required',
                'course_id'     => 'required',
                'user_id'       => 'required',
            ],
            [
                'department_id.required' => "Bölüm alanı boş bırakılamaz.",
                'class_id.required'      => "Sınıf alanı boş bırakılamaz.",
                'year_term_id.required'  => "Dönem alanı boş bırakılamaz.",
                'course_id.required'     => "Ders alanı boş bırakılamaz.",
                'user_id.required'       => "Öğretim Görevlisi alanı boş bırakılamaz.",
            ]
        );

        Assignment::create(
            $request->only(['department_id', 'class_id', 'year_term_id', 'course_id', 'user_id'])
        );

        return redirect('/assignment')
                ->with('success', 'Ders atama işlemi başarılı bir şekilde gerçekleştirildi.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        $departments = Department::all();
        $classes = Classes::all();
        $yearTerms = YearTerm::all();
        $courses = Course::all();
        $users = User::all();

        return view('assignment.edit', compact('assignment', 'departments', 'classes', 'yearTerms', 'courses', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {
        $request->validate(
            [
                'department_id' => 'required',
                'class_id'      => 'required',
                'year_term_id'  => 'required',
                'course_id'     => 'required',
                'user_id'       => 'required',
            ],
            [
                'department_id.required' => "Bölüm alanı boş bırakılamaz.",
                'class_id.required'      => "Sınıf alanı boş bırakılamaz.",
                'year_term_id.required'  => "Dönem alanı boş bırakılamaz.",
                'course_id.required'     => "Ders alanı boş bırakılamaz.",
                'user_id.required'       => "Öğretim Görevlisi alanı boş bırakılamaz.",
            ]
        );

        $assignment->update(
            $request->only(['department_id', 'class_id', 'year_term_id', 'course_id', 'user_id'])
        );

        return redirect('/assignment')
                ->with('success', 'Atanmış ders başarılı bir şekilde güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        $assignment->delete();

        return redirect('/assignment')
                ->with('success', 'Atanmış ders başarılı bir şekilde silindi.');
    }
}

