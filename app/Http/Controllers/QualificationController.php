<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Qualification;
use App\Models\Department;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Department $department)
    {
        $qualifications = $department->qualifications;
        $qualificationCount = $qualifications->count();

        return view('qualification.create', compact('qualifications', 'qualificationCount'));
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
                'name.*' => 'required'
            ],
            [
                'name.required' => 'Yeterlilik adı boş bırakılamaz.'
            ]
        );

        foreach($request->name as $qualification){
            Qualification::create([
                'name'          => $qualification,
                'department_id' => $request->department_id
            ]);
        }

        return \Redirect::route('department.index');
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
        $qualifications = $department->qualifications;

        return view('qualification.edit', compact('qualifications'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Qualification $qualification)
    {
        $qualification->update(
            $request->only(['name'])
        );

        return \Redirect::route('qualification.edit', $request->department_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Qualification $qualification)
    {
        $qualification->delete();

        return \Redirect::route('qualification.edit', $request->department_id);
    }
}
