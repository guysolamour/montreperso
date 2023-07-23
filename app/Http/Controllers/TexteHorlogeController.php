<?php

namespace App\Http\Controllers;

use App\TexteHorloge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TexteHorlogeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $texteHorloges = TexteHorloge::latest()->paginate(5);

        return view('TexteHorloge.index',compact('texteHorloges'))
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
                 return view('TexteHorloge.create');
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
        $texteHorloge= new TexteHorloge();
        $texteHorloge->id_police = $request->id_police;
        $texteHorloge->taille_police = $request->taille_police;
        $texteHorloge->id_couleur = $request->id_couleur;
        $texteHorloge->id_position_texte = $request->id_position_texte;
        $texteHorloge->contenu_texte = $request->contenu_texte;
        $texteHorloge->id_horloge_client = $request->id_horloge_client;
        $texteHorloge->save();

        return redirect()->route('texte_horloge.index')
               ->with('success','TexteHorloge créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TexteHorloge  $texteHorloge
     * @return \Illuminate\Http\Response
     */
    public function show(TexteHorloge $texteHorloge)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TexteHorloge  $texteHorloge
     * @return \Illuminate\Http\Response
     */
    public function edit(TexteHorloge $texteHorloge)
    {
        //
                return view('TexteHorloge.edit',compact('texteHorloge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TexteHorloge  $texteHorloge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TexteHorloge $texteHorloge)
    {
        //
                $texteHorloge->id_police = $request->id_police;
        $texteHorloge->taille_police = $request->taille_police;
        $texteHorloge->id_couleur = $request->id_couleur;
        $texteHorloge->id_position_texte = $request->id_position_texte;
        $texteHorloge->contenu_texte = $request->contenu_texte;
        $texteHorloge->id_horloge_client = $request->id_horloge_client;
        $texteHorloge->save();

        return redirect()->route('texte_horloge.index')
               ->with('success','TexteHorloge modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TexteHorloge  $texteHorloge
     * @return \Illuminate\Http\Response
     */
    public function destroy(TexteHorloge $texteHorloge)
    {
        //
        $texteHorloge->delete();
        return redirect()->route('texte_horloge.index')
               ->with('success','TexteHorloge supprimé avec succès');
    }
}
