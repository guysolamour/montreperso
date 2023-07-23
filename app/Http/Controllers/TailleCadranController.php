<?php

namespace App\Http\Controllers;

use App\TailleCadran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TailleCadranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tailleCadrans = TailleCadran::latest()->paginate(5);

        return view('TailleCadran.index',compact('tailleCadrans'))
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
                 return view('TailleCadran.create');
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
        $tailleCadran= new TailleCadran();
        $tailleCadran->valeur_taille = $request->valeur_taille;
        $tailleCadran->save();

        return redirect()->route('taille_cadran.index')
               ->with('success','TailleCadran créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TailleCadran  $tailleCadran
     * @return \Illuminate\Http\Response
     */
    public function show(TailleCadran $tailleCadran)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TailleCadran  $tailleCadran
     * @return \Illuminate\Http\Response
     */
    public function edit(TailleCadran $tailleCadran)
    {
        //
                return view('TailleCadran.edit',compact('tailleCadran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TailleCadran  $tailleCadran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TailleCadran $tailleCadran)
    {
        //
                $tailleCadran->valeur_taille = $request->valeur_taille;
        $tailleCadran->save();

        return redirect()->route('taille_cadran.index')
               ->with('success','TailleCadran modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TailleCadran  $tailleCadran
     * @return \Illuminate\Http\Response
     */
    public function destroy(TailleCadran $tailleCadran)
    {
        //
        $tailleCadran->delete();
        return redirect()->route('taille_cadran.index')
               ->with('success','TailleCadran supprimé avec succès');
    }
}
