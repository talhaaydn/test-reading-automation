<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Term;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terms = Term::all();

        return view('term.index', compact('terms')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('term.create');
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
                'term' => 'required|unique:terms'
            ],
            [
                'term.required' => 'Dönem alanı boş bırakılamaz.',
                'term.unique'   => 'Bu dönem daha önce oluşturulmuş.',
            ]
        );

        Term::create(
            $request->only(['term'])
        );

        return redirect('/term')
                ->with('success', 'Dönem oluşturma işlemi başarılı bir şekilde gerçekleştirildi.');
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
    public function edit(Term $term)
    {
        return view('term.edit', compact('term'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Term $term)
    {
        $request->validate(
            [
                'term' => 'required'
            ],
            [
                'term.required' => 'Dönem alanı boş bırakılamaz.',
            ]
        );

        $term->update(
            $request->only(['term'])
        );
        
        return redirect('/term')
                ->with('success', 'Dönem güncelleme işlemi başarılı bir şekilde gerçekleştirildi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Term $term)
    {
        $term->delete();

        return redirect('/term')
                ->with('success', 'Dönem silme işlemi başarılı bir şekilde gerçekleştirildi.');
    }
}
