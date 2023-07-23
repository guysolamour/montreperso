<?php

namespace App\Http\Controllers;

use App\PositionTexte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PositionTexteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $positionTextes = PositionTexte::latest()->paginate(5);

        return view('PositionTexte.index',compact('positionTextes'))
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
                 return view('PositionTexte.create');
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
        $positionTexte= new PositionTexte();
        $positionTexte->valeur_position = $request->valeur_position;
        $positionTexte->valeur_anglaise = $request->valeur_anglaise;
        $positionTexte->save();

        return redirect()->route('position_texte.index')
               ->with('success','PositionTexte créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PositionTexte  $positionTexte
     * @return \Illuminate\Http\Response
     */
    public function show(PositionTexte $positionTexte)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PositionTexte  $positionTexte
     * @return \Illuminate\Http\Response
     */
    public function edit(PositionTexte $positionTexte)
    {
        //
                return view('PositionTexte.edit',compact('positionTexte'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PositionTexte  $positionTexte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PositionTexte $positionTexte)
    {
        //
                $positionTexte->valeur_position = $request->valeur_position;
        $positionTexte->valeur_anglaise = $request->valeur_anglaise;
        $positionTexte->save();

        return redirect()->route('position_texte.index')
               ->with('success','PositionTexte modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PositionTexte  $positionTexte
     * @return \Illuminate\Http\Response
     */
    public function destroy(PositionTexte $positionTexte)
    {
        //
        $positionTexte->delete();
        return redirect()->route('position_texte.index')
               ->with('success','PositionTexte supprimé avec succès');
    }
}
