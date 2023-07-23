<?php

namespace App\Http\Controllers;

use App\CouleurBracelet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class CouleurBraceletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $couleurBracelets = CouleurBracelet::latest()->paginate(5);

        return view('CouleurBracelet.index',compact('couleurBracelets'))
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
        return view('CouleurBracelet.create');
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
        $couleurBracelet= new CouleurBracelet();
        $couleurBracelet->nom_couleur = $request->nom_couleur;
        // $couleurBracelet->image_bracelet_couleur = $request->image_bracelet_couleur;

        if($request->file('image_bracelet_couleur')) {

            $image_file = $request->file('image_bracelet_couleur');
            $image_bracelet_couleur = date("YmdHis").".".$image_file->getClientOriginalExtension();
            $image_file->move('uploads/couleur_bracelet', $image_bracelet_couleur);
            $couleurBracelet->image_bracelet_couleur = $image_bracelet_couleur;

        } 


        $couleurBracelet->save();

        return redirect()->route('couleur_bracelet.index')
               ->with('success','CouleurBracelet créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CouleurBracelet  $couleurBracelet
     * @return \Illuminate\Http\Response
     */
    public function show(CouleurBracelet $couleurBracelet)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CouleurBracelet  $couleurBracelet
     * @return \Illuminate\Http\Response
     */
    public function edit(CouleurBracelet $couleurBracelet)
    {
        //
                return view('CouleurBracelet.edit',compact('couleurBracelet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CouleurBracelet  $couleurBracelet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CouleurBracelet $couleurBracelet)
    {
        //
        $couleurBracelet->nom_couleur = $request->nom_couleur;
        // $couleurBracelet->image_bracelet_couleur = $request->image_bracelet_couleur;

        if($request->file('image_bracelet_couleur')) {
            //Suppression de l'ancien fichier
            $file_name = "uploads/couleur_bracelet/".$couleurBracelet->image_bracelet_couleur;
            File::delete($file_name);

            $image_file = $request->file('image_bracelet_couleur');
            $image_bracelet_couleur = date("YmdHis").".".$image_file->getClientOriginalExtension();
            $image_file->move('uploads/couleur_bracelet', $image_bracelet_couleur);
            $couleurBracelet->image_bracelet_couleur = $image_bracelet_couleur;

        } 

        $couleurBracelet->save();

        return redirect()->route('couleur_bracelet.index')
               ->with('success','CouleurBracelet modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CouleurBracelet  $couleurBracelet
     * @return \Illuminate\Http\Response
     */
    public function destroy(CouleurBracelet $couleurBracelet)
    {
        //
         //Suppression de l'ancien fichier
         $file_name = "uploads/couleur_bracelet/".$couleurBracelet->image_bracelet_couleur;
         File::delete($file_name);
        $couleurBracelet->delete();
        return redirect()->route('couleur_bracelet.index')
               ->with('success','CouleurBracelet supprimé avec succès');
    }
}
