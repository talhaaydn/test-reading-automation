<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        return view('course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('course.create');
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
                'name'        => 'required|unique:courses',
                'course_code' => 'required|unique:courses'
            ],
            [
                'name.required'        => 'Ders adı boş bırakılamaz.',
                'name.unique'          => 'Bu ders daha önce eklenmiş.',
                'course_code.required' => 'Ders kodu boş bırakılamaz.',
                'course_code.unique'   => 'Bu ders kodu daha önce eklenmiş.'
            ]
        );
        Course::create(
            $request->only(['course_code', 'name'])
        );

        return redirect('/course')
                ->with('success', 'Ders oluşturma işlemi başarılı bir şekilde gerçekleştirildi.');
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
    public function edit(Course $course)
    {
        return view('course.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $request->validate(
            [
                'name'        => 'required',
                'course_code' => 'required'
            ],
            [
                'name.required'        => 'Ders adı boş bırakılamaz.',
                'course_code.required' => 'Ders kodu boş bırakılamaz.'
            ]
        );

        $course->update(
            $request->only(['course_code', 'name'])
        );
        
        return redirect('/course')
                ->with('success', 'Ders güncelleme işlemi başarılı bir şekilde gerçekleştirildi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect('/course')
                ->with('success', 'Ders silme işlemi başarılı bir şekilde gerçekleştirildi.');
    }
}
