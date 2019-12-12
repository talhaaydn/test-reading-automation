<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Faculty;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faculties = Faculty::all();
        
        return view('faculty.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('faculty.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:faculties'
            ],
            [
                'name.required' => 'Fakülte alanı boş bırakılamaz.',
                'name.unique'   => 'Bu fakülte daha önce oluşturulmuş',
            ]
        );

        Faculty::create(
            $request->only(['name'])
        );

        return redirect('/faculty')
                ->with('success', 'Fakülte oluşturma işlemi başarılı bir şekilde gerçekleştirildi.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faculty $faculty)
    {
        return view('faculty.edit', compact('faculty')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faculty $faculty)
    {
        $request->validate(
            [
                'name' => 'required'
            ],
            [
                'name.required' => 'Fakülte alanı boş bırakılamaz.',
            ]
        );

        $faculty->update(
            $request->only(['name'])
        );
        
        return redirect('/faculty')
                ->with('success', 'Fakülte güncelleme işlemi başarılı bir şekilde gerçekleştirildi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faculty $faculty)
    {
        $faculty->delete();

        return redirect('/faculty')
                ->with('success', 'Fakülte silme işlemi başarılı bir şekilde gerçekleştirildi.');
    }
}
