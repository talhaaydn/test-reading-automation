<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classes::all();
        return view('class.index', compact('classes')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('class.create');
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
                'name' => 'required|unique:classes'
            ],
            [
                'name.required' => 'Sınıf alanı boş bırakılamaz.',
                'name.unique'   => 'Bu sınıf daha önce oluşturulmuş',
            ]
        );

        Classes::create(
            $request->only(['name'])
        );

        return redirect('/class')
                ->with('success', 'Sınıf oluşturma işlemi başarılı bir şekilde gerçekleştirildi.');
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
    public function edit(Classes $class)
    {
        return view('class.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classes $class)
    {
        $request->validate(
            [
                'name' => 'required'
            ],
            [
                'name.required' => 'Sınıf alanı boş bırakılamaz.',
            ]
        );

        $class->update(
            $request->only(['name'])
        );
        
        return redirect('/class')
                ->with('success', 'Sınıf güncelleme işlemi başarılı bir şekilde gerçekleştirildi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $class)
    {
        $class->delete();

        return redirect('/class')
                ->with('success', 'Sınıf silme işlemi başarılı bir şekilde gerçekleştirildi.');
    }
    
}
