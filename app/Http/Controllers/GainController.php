<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Gain;

class GainController extends Controller
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
    public function create(Course $course)
    {
        $gains = $course->gains;
        $gainCount = $gains->count();

        return view('gain.create', compact('course', 'gains', 'gainCount'));
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
                'name.required' => 'Kazanım adı boş bırakılamaz.'
            ]
        );
        

        foreach($request->name as $gain){
            Gain::create([
                'name'          => $gain,
                'course_id'     => $request->course_id
            ]);
        }

        return \Redirect::route('course.index');
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
        $gains = $course->gains;

        return view('gain.edit', compact('course', 'gains'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gain $gain)
    {
        $gain->update(
            $request->only(['name'])
        );

        return \Redirect::route('gain.edit', $request->course_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Gain $gain)
    {
        $gain->delete();

        return \Redirect::route('gain.edit', $request->course_id);
    }
}
