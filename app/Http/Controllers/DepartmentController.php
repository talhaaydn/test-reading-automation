<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\Faculty;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();

        return view('department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculties = Faculty::all();

        return view('department.create', compact('faculties'));
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
                'name'       => 'required|unique:departments',
                'faculty_id' => 'required'
            ],
            [
                'name.required'         => "Bölüm adı boş bırakılamaz.",
                'name.unique'           => "Bu bölüm adı daha önce oluşturulmuş.",
                'faculty_id.required'   => "Her bölüm bir fakülteye ait olmalıdır.",
            ]
        );

        Department::create(
            $request->only(['name', 'faculty_id'])
        );

        return redirect('/department')
                ->with('success', 'Bölüm oluşturma işlemi başarılı bir şekilde gerçekleştirildi.');
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
    public function edit(Department $department)
    {
        $faculties = Faculty::all();

        return view('department.edit', compact('department', 'faculties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $request->validate(
            [
                'name'       => 'required',
                'faculty_id' => 'required'
            ],
            [
                'name.required'         => "Bölüm adı boş bırakılamaz.",
                'faculty_id.required'   => "Her bölüm bir fakülteye ait olmalıdır."
            ]
        );

        $department->update(
            $request->only(['name', 'faculty_id'])
        );

        return redirect('/department')
                ->with('success', 'Bölüm güncelleme işlemi başarılı bir şekilde gerçekleştirildi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect('/department')
                ->with('success', 'Bölüm silme işlemi başarılı bir şekilde gerçekleştirildi.');
    }
}
