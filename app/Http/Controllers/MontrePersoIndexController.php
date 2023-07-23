<?php

namespace App\Http\Controllers;

use App\MontrePersoIndex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MontrePersoIndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $montrePersoIndexs = MontrePersoIndex::latest()->paginate(5);

        return view('MontrePersoIndex.index',compact('montrePersoIndexs'))
                  ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
                 return view('MontrePersoIndex.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $montrePersoIndex= new MontrePersoIndex();
        $montrePersoIndex->nom_index = $request->nom_index;
        $montrePersoIndex->save();

        return redirect()->route('montre_perso_index.index')
               ->with('success','MontrePersoIndex créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MontrePersoIndex  $montrePersoIndex
     * @return \Illuminate\Http\Response
     */
    public function show(MontrePersoIndex $montrePersoIndex)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MontrePersoIndex  $montrePersoIndex
     * @return \Illuminate\Http\Response
     */
    public function edit(MontrePersoIndex $montrePersoIndex)
    {
        //
                return view('MontrePersoIndex.edit',compact('montrePersoIndex'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MontrePersoIndex  $montrePersoIndex
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MontrePersoIndex $montrePersoIndex)
    {
        //
                $montrePersoIndex->nom_index = $request->nom_index;
        $montrePersoIndex->save();

        return redirect()->route('montre_perso_index.index')
               ->with('success','MontrePersoIndex modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MontrePersoIndex  $montrePersoIndex
     * @return \Illuminate\Http\Response
     */
    public function destroy(MontrePersoIndex $montrePersoIndex)
    {
        //
        $montrePersoIndex->delete();
        return redirect()->route('montre_perso_index.index')
               ->with('success','MontrePersoIndex supprimé avec succès');
    }
}
