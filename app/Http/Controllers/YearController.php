<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Year;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = Year::all();

        return view('year.index', compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('year.create');
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
                'year' => 'required|unique:years'
            ],
            [
                'year.required' => 'Yıl alanı boş bırakılamaz.',
                'year.unique'   => 'Bu yıl daha önce oluşturulmuş',
            ]
        );

       Year::create(
            $request->only(['year'])
        );

        return redirect('/year')
                ->with('success', 'Yıl oluşturma işlemi başarılı bir şekilde gerçekleştirildi.');
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
    public function edit(Year $year)
    {
        return view('year.edit', compact('year'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Year $year)
    {
        $request->validate(
            [
                'year' => 'required'
            ],
            [
                'year.required' => 'Yıl alanı boş bırakılamaz.',
            ]
        );

        $year->update(
            $request->only(['year'])
        );
        
        return redirect('/year')
                ->with('success', 'Yıl güncelleme işlemi başarılı bir şekilde gerçekleştirildi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Year $year)
    {
        $year->delete();

        return redirect('/year')
                ->with('success', 'Yıl silme işlemi başarılı bir şekilde gerçekleştirildi.');
    }
}
