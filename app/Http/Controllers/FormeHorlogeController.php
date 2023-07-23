<?php

namespace App\Http\Controllers;

use App\FormeHorloge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class FormeHorlogeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $formeHorloges = FormeHorloge::latest()->paginate(5);

        return view('FormeHorloge.index',compact('formeHorloges'))
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
                 return view('FormeHorloge.create');
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
        $formeHorloge= new FormeHorloge();
        $formeHorloge->libelle_forme = $request->libelle_forme;
        // $formeHorloge->image_forme = $request->image_forme;

        if($request->file('image_forme')) {

            $image_file = $request->file('image_forme');
            $image_forme = date("YmdHis").".".$image_file->getClientOriginalExtension();
            $image_file->move('uploads/forme_horloge', $image_forme);
            $formeHorloge->image_forme = $image_forme;

        } 
        $formeHorloge->save();

        return redirect()->route('forme_horloge.index')
               ->with('success','FormeHorloge créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FormeHorloge  $formeHorloge
     * @return \Illuminate\Http\Response
     */
    public function show(FormeHorloge $formeHorloge)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FormeHorloge  $formeHorloge
     * @return \Illuminate\Http\Response
     */
    public function edit(FormeHorloge $formeHorloge)
    {
        //
                return view('FormeHorloge.edit',compact('formeHorloge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FormeHorloge  $formeHorloge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormeHorloge $formeHorloge)
    {
        //
                $formeHorloge->libelle_forme = $request->libelle_forme;
        // $formeHorloge->image_forme = $request->image_forme;
        if($request->file('image_forme')) {
            //Suppression de l'ancien fichier
            $file_name = "uploads/forme_horloge/".$formeHorloge->image_forme;
            File::delete($file_name);

            $image_file = $request->file('image_forme');
            $image_forme = date("YmdHis").".".$image_file->getClientOriginalExtension();
            $image_file->move('uploads/forme_horloge', $image_forme);
            $formeHorloge->image_forme = $image_forme;

        } 
        $formeHorloge->save();

        return redirect()->route('forme_horloge.index')
               ->with('success','FormeHorloge modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FormeHorloge  $formeHorloge
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormeHorloge $formeHorloge)
    {
        //
         //Suppression du fichier
         $file_name = "uploads/forme_horloge/".$formeHorloge->image_forme;
         File::delete($file_name);

        $formeHorloge->delete();
        return redirect()->route('forme_horloge.index')
               ->with('success','FormeHorloge supprimé avec succès');
    }
}
