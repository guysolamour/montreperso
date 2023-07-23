<?php

namespace App\Http\Controllers;

use App\FormeMontre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class FormeMontreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $formeMontres = FormeMontre::latest()->paginate(5);

        return view('FormeMontre.index',compact('formeMontres'))
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
                 return view('FormeMontre.create');
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
        $formeMontre= new FormeMontre();
        $formeMontre->libelle_forme = $request->libelle_forme;
        // $formeMontre->image_forme = $request->image_forme;
        if($request->file('image_forme')) {

            $image_file = $request->file('image_forme');
            $image_forme = date("YmdHis").".".$image_file->getClientOriginalExtension();
            $image_file->move('uploads/forme_montre', $image_forme);
            $formeMontre->image_forme = $image_forme;

        } 
        $formeMontre->save();

        return redirect()->route('forme_montre.index')
               ->with('success','FormeMontre créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FormeMontre  $formeMontre
     * @return \Illuminate\Http\Response
     */
    public function show(FormeMontre $formeMontre)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FormeMontre  $formeMontre
     * @return \Illuminate\Http\Response
     */
    public function edit(FormeMontre $formeMontre)
    {
        //
                return view('FormeMontre.edit',compact('formeMontre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FormeMontre  $formeMontre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormeMontre $formeMontre)
    {
        //
        $formeMontre->libelle_forme = $request->libelle_forme;
        // $formeMontre->image_forme = $request->image_forme;

        if($request->file('image_forme')) {
            //Suppression de l'ancien fichier
            $file_name = "uploads/forme_montre/".$formeMontre->image_forme;
            File::delete($file_name);

            $image_file = $request->file('image_forme');
            $image_forme = date("YmdHis").".".$image_file->getClientOriginalExtension();
            $image_file->move('uploads/forme_montre', $image_forme);
            $formeMontre->image_forme = $image_forme;

        } 

        $formeMontre->save();

        return redirect()->route('forme_montre.index')
               ->with('success','FormeMontre modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FormeMontre  $formeMontre
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormeMontre $formeMontre)
    {
        //
         //Suppression de l'ancien fichier
         $file_name = "uploads/forme_montre/".$formeMontre->image_forme;
         File::delete($file_name);
        $formeMontre->delete();
        return redirect()->route('forme_montre.index')
               ->with('success','FormeMontre supprimé avec succès');
    }
}
