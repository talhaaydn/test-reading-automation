<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\YearTerm;
use App\Models\Year;
use App\Models\Term;

class YearTermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $yearTerms = YearTerm::all();

        return view('year-term.index', compact('yearTerms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $years = Year::all();
        $terms = Term::all();

        return view('year-term.create', compact('years', 'terms'));
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
                'year_id' => 'required',
                'term_id' => 'required'
            ],
            [
                'year_id.required' => 'Yıl alanı boş bırakılamaz.',
                'term_id.unique'   => 'Dönem alanı boş bırakılamaz.'
            ]
        );

        $isExist = YearTerm::isExist($request->year_id, $request->term_id);            

        if($isExist > 0) {
            return redirect('/year-term')
                    ->with('warning', 'Başarısız bu yıl-dönem daha önce eklendi.');
        }

        YearTerm::create(
            $request->only(['year_id', 'term_id'])
        );

        return redirect('/year-term')
        ->with('success', 'Yıl-Dönem oluşturma işlemi başarılı bir şekilde gerçekleştirildi.');
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
    public function edit(YearTerm $yearTerm)
    {
        $years = Year::all();
        $terms = Term::all();

        return view('year-term.edit', compact('yearTerm', 'years', 'terms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, YearTerm $yearTerm)
    {
        $request->validate(
            [
                'year_id' => 'required',
                'term_id' => 'required'
            ],
            [
                'year_id.required' => 'Yıl alanı boş bırakılamaz.',
                'term_id.unique'   => 'Dönem alanı boş bırakılamaz.'
            ]
        );

        $isExist = YearTerm::isExist($request->year_id, $request->term_id);        

        if($isExist > 0) {
            return redirect('/year-term')
                    ->with('warning', 'Başarısız bu yıl-dönem daha önce eklendi.');
        }

        $yearTerm->update(
            $request->only(['year_id', 'term_id'])
        );
        
        return redirect('/year-term')
                ->with('success', 'Yıl-Dönem güncelleme işlemi başarılı bir şekilde gerçekleştirildi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(YearTerm $yearTerm)
    {
        $yearTerm->delete();

        return redirect('/year-term')
                ->with('success', 'Yıl-Dönem  silme işlemi başarılı bir şekilde gerçekleştirildi.');
    }
}
