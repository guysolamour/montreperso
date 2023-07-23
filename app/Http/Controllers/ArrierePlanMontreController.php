<?php

namespace App\Http\Controllers;

use App\ArrierePlanMontre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class ArrierePlanMontreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $arrierePlanMontres = ArrierePlanMontre::latest()->paginate(5);

        return view('ArrierePlanMontre.index',compact('arrierePlanMontres'))
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
                 return view('ArrierePlanMontre.create');
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
        $arrierePlanMontre= new ArrierePlanMontre();
        $arrierePlanMontre->nom_arriere_plan = $request->nom_arriere_plan;
        // $arrierePlanMontre->image_arriere_plan = $request->image_arriere_plan;

        
        if($request->file('image_arriere_plan')) {
            $image_file = $request->file('image_arriere_plan');
            $image_arriere_plan = date("YmdHis").".".$image_file->getClientOriginalExtension();
            $image_file->move('uploads/arriere_plan_montre', $image_arriere_plan);
            $arrierePlanMontre->image_arriere_plan = $image_arriere_plan;

        }     
        $arrierePlanMontre->save();

        return redirect()->route('arriere_plan_montre.index')
               ->with('success','ArrierePlanMontre créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ArrierePlanMontre  $arrierePlanMontre
     * @return \Illuminate\Http\Response
     */
    public function show(ArrierePlanMontre $arrierePlanMontre)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ArrierePlanMontre  $arrierePlanMontre
     * @return \Illuminate\Http\Response
     */
    public function edit(ArrierePlanMontre $arrierePlanMontre)
    {
        //
                return view('ArrierePlanMontre.edit',compact('arrierePlanMontre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ArrierePlanMontre  $arrierePlanMontre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArrierePlanMontre $arrierePlanMontre)
    {
        //
        $arrierePlanMontre->nom_arriere_plan = $request->nom_arriere_plan;
        // $arrierePlanMontre->image_arriere_plan = $request->image_arriere_plan;

        if($request->file('image_arriere_plan')) {
            //Suppression de l'ancien fichier
            $file_name = "uploads/arriere_plan_montre/".$arrierePlanMontre->image_arriere_plan;
            File::delete($file_name);

            $image_file = $request->file('image_arriere_plan');
            $image_arriere_plan = date("YmdHis").".".$image_file->getClientOriginalExtension();
            $image_file->move('uploads/arriere_plan_montre', $image_arriere_plan);
            $arrierePlanMontre->image_arriere_plan = $image_arriere_plan;

        }    
        $arrierePlanMontre->save();

        return redirect()->route('arriere_plan_montre.index')
               ->with('success','ArrierePlanMontre modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ArrierePlanMontre  $arrierePlanMontre
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArrierePlanMontre $arrierePlanMontre)
    {
        //
        $file_name = "uploads/arriere_plan_montre/".$arrierePlanMontre->image_arriere_plan;
        File::delete($file_name);
        $arrierePlanMontre->delete();
        return redirect()->route('arriere_plan_montre.index')
               ->with('success','ArrierePlanMontre supprimé avec succès');
    }
}
