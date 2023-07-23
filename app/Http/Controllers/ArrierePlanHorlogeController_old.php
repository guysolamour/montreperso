<?php

namespace App\Http\Controllers;

use App\ArrierePlanHorloge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ArrierePlanHorlogeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $arrierePlanHorloges = ArrierePlanHorloge::latest()->paginate(5);

        return view('ArrierePlanHorloge.index',compact('arrierePlanHorloges'))
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
                 return view('ArrierePlanHorloge.create');
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
        $arrierePlanHorloge= new ArrierePlanHorloge();
        $arrierePlanHorloge->nom_arriere_plan = $request->nom_arriere_plan;
        $arrierePlanHorloge->image_arriere_plan = $request->image_arriere_plan;
        $arrierePlanHorloge->save();

        return redirect()->route('arriere_plan_horloge.index')
               ->with('success','ArrierePlanHorloge créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ArrierePlanHorloge  $arrierePlanHorloge
     * @return \Illuminate\Http\Response
     */
    public function show(ArrierePlanHorloge $arrierePlanHorloge)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ArrierePlanHorloge  $arrierePlanHorloge
     * @return \Illuminate\Http\Response
     */
    public function edit(ArrierePlanHorloge $arrierePlanHorloge)
    {
        //
                return view('ArrierePlanHorloge.edit',compact('arrierePlanHorloge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ArrierePlanHorloge  $arrierePlanHorloge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArrierePlanHorloge $arrierePlanHorloge)
    {
        //
                $arrierePlanHorloge->nom_arriere_plan = $request->nom_arriere_plan;
        $arrierePlanHorloge->image_arriere_plan = $request->image_arriere_plan;
        $arrierePlanHorloge->save();

        return redirect()->route('arriere_plan_horloge.index')
               ->with('success','ArrierePlanHorloge modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ArrierePlanHorloge  $arrierePlanHorloge
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArrierePlanHorloge $arrierePlanHorloge)
    {
        //
        $arrierePlanHorloge->delete();
        return redirect()->route('arriere_plan_horloge.index')
               ->with('success','ArrierePlanHorloge supprimé avec succès');
    }
}
