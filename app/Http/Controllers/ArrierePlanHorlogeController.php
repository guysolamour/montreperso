<?php

namespace App\Http\Controllers;

use App\ArrierePlanHorloge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


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
       

        if($request->file('image_arriere_plan')) {
            $image_file = $request->file('image_arriere_plan');
            $image_arriere_plan = date("YmdHis").".".$image_file->getClientOriginalExtension();
            $image_file->move('uploads/arriere_plan_horloge', $image_arriere_plan);
           // $fichier->move('images/clients',$nom_fichier);
            $arrierePlanHorloge->image_arriere_plan = $image_arriere_plan;

        }     
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
        //$arrierePlanHorloge->image_arriere_plan = $request->image_arriere_plan;

        if($request->file('image_arriere_plan')) {
            //Suppression de l'ancien fichier
            $file_name = "uploads/arriere_plan_horloge/".$arrierePlanHorloge->image_arriere_plan;
            File::delete($file_name);

            $image_file = $request->file('image_arriere_plan');
            $image_arriere_plan = date("YmdHis").".".$image_file->getClientOriginalExtension();
            $image_file->move('uploads/arriere_plan_horloge', $image_arriere_plan);
           // $fichier->move('images/clients',$nom_fichier);
            $arrierePlanHorloge->image_arriere_plan = $image_arriere_plan;

        }    

        $arrierePlanHorloge->save();

        return redirect()->route('arriere_plan_horloge.index')
               ->with('success','ArrierePlanHorloge updated avec succès');
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
        $file_name = "uploads/arriere_plan_horloge/".$arrierePlanHorloge->image_arriere_plan;
       // dd($file_name);
        File::delete($file_name);

        $arrierePlanHorloge->delete();
        return redirect()->route('arriere_plan_horloge.index')
               ->with('success','ArrierePlanHorloge deleted avec succès');
    }
}
