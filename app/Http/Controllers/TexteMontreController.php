<?php

namespace App\Http\Controllers;

use App\TexteMontre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TexteMontreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $texteMontres = TexteMontre::latest()->paginate(5);

        return view('TexteMontre.index',compact('texteMontres'))
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
                 return view('TexteMontre.create');
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
        $texteMontre= new TexteMontre();
        $texteMontre->id_police = $request->id_police;
        $texteMontre->taille_police = $request->taille_police;
        $texteMontre->id_couleur = $request->id_couleur;
        $texteMontre->id_position_texte = $request->id_position_texte;
        $texteMontre->contenu_texte = $request->contenu_texte;
        $texteMontre->id_montre_client = $request->id_montre_client;
        $texteMontre->save();

        return redirect()->route('texte_montre.index')
               ->with('success','TexteMontre créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TexteMontre  $texteMontre
     * @return \Illuminate\Http\Response
     */
    public function show(TexteMontre $texteMontre)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TexteMontre  $texteMontre
     * @return \Illuminate\Http\Response
     */
    public function edit(TexteMontre $texteMontre)
    {
        //
                return view('TexteMontre.edit',compact('texteMontre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TexteMontre  $texteMontre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TexteMontre $texteMontre)
    {
        //
                $texteMontre->id_police = $request->id_police;
        $texteMontre->taille_police = $request->taille_police;
        $texteMontre->id_couleur = $request->id_couleur;
        $texteMontre->id_position_texte = $request->id_position_texte;
        $texteMontre->contenu_texte = $request->contenu_texte;
        $texteMontre->id_montre_client = $request->id_montre_client;
        $texteMontre->save();

        return redirect()->route('texte_montre.index')
               ->with('success','TexteMontre modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TexteMontre  $texteMontre
     * @return \Illuminate\Http\Response
     */
    public function destroy(TexteMontre $texteMontre)
    {
        //
        $texteMontre->delete();
        return redirect()->route('texte_montre.index')
               ->with('success','TexteMontre supprimé avec succès');
    }
}
