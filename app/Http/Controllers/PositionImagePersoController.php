<?php

namespace App\Http\Controllers;

use App\PositionImagePerso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PositionImagePersoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $positionImagePersos = PositionImagePerso::latest()->paginate(5);

        return view('PositionImagePerso.index',compact('positionImagePersos'))
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
                 return view('PositionImagePerso.create');
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
        $positionImagePerso= new PositionImagePerso();
        $positionImagePerso->valeur_position_img = $request->valeur_position_img;
        $positionImagePerso->valeur_anglaise = $request->valeur_anglaise;
        $positionImagePerso->save();

        return redirect()->route('position_image_perso.index')
               ->with('success','PositionImagePerso créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PositionImagePerso  $positionImagePerso
     * @return \Illuminate\Http\Response
     */
    public function show(PositionImagePerso $positionImagePerso)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PositionImagePerso  $positionImagePerso
     * @return \Illuminate\Http\Response
     */
    public function edit(PositionImagePerso $positionImagePerso)
    {
        //
                return view('PositionImagePerso.edit',compact('positionImagePerso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PositionImagePerso  $positionImagePerso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PositionImagePerso $positionImagePerso)
    {
        //
                $positionImagePerso->valeur_position_img = $request->valeur_position_img;
        $positionImagePerso->valeur_anglaise = $request->valeur_anglaise;
        $positionImagePerso->save();

        return redirect()->route('position_image_perso.index')
               ->with('success','PositionImagePerso modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PositionImagePerso  $positionImagePerso
     * @return \Illuminate\Http\Response
     */
    public function destroy(PositionImagePerso $positionImagePerso)
    {
        //
        $positionImagePerso->delete();
        return redirect()->route('position_image_perso.index')
               ->with('success','PositionImagePerso supprimé avec succès');
    }
}
