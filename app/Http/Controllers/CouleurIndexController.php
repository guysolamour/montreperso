<?php

namespace App\Http\Controllers;

use App\CouleurIndex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class CouleurIndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $couleurIndexs = CouleurIndex::latest()->paginate(5);

        return view('CouleurIndex.index',compact('couleurIndexs'))
                  ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    
    public function list_index($id)
    {
        //
        $couleurIndexs = CouleurIndex::where('id_forme_montre',$id)->get();

        return view('CouleurIndex.list_index',compact('couleurIndexs'));

    }


    // public function indexs_carres()
    // {
    //     //
    //     $couleurIndexs = CouleurIndex::where('id_forme_montre',2)->get();

    //     return view('CouleurIndex.list_index',compact('couleurIndexs'));


       
    // }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $query =  'SELECT * FROM montre_perso_index ; ' ;
        $montrePersoIndexs = DB::select($query);

        $query =  'SELECT * FROM forme_montre ; ' ;
        $formeMontres = DB::select($query);

        return view('CouleurIndex.create',compact('montrePersoIndexs','formeMontres'));
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
        $couleurIndex= new CouleurIndex();
        $couleurIndex->nom_couleur = $request->nom_couleur;
        $couleurIndex->id_forme_montre = $request->id_forme_montre;
        $couleurIndex->id_index = $request->id_index;

        if($request->file('image_couleur_index')) {
            $image_file = $request->file('image_couleur_index');
            $image_couleur_index = date("YmdHis").".".$image_file->getClientOriginalExtension();
            $image_file->move('uploads/couleur_index', $image_couleur_index);
            $couleurIndex->image_couleur_index = $image_couleur_index;
        }     
        
        $couleurIndex->save();

        return redirect()->route('couleur_index.index')
               ->with('success','CouleurIndex créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CouleurIndex  $couleurIndex
     * @return \Illuminate\Http\Response
     */
    public function show(CouleurIndex $couleurIndex)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CouleurIndex  $couleurIndex
     * @return \Illuminate\Http\Response
     */
    public function edit(CouleurIndex $couleurIndex)
    {
        //
                $query =  'SELECT * FROM montre_perso_index ; ' ;
        $montrePersoIndexs = DB::select($query);

        $query =  'SELECT * FROM forme_montre ; ' ;
        $formeMontres = DB::select($query);

        return view('CouleurIndex.edit',compact('couleurIndex','montrePersoIndexs','formeMontres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CouleurIndex  $couleurIndex
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CouleurIndex $couleurIndex)
    {
        //
        $couleurIndex->nom_couleur = $request->nom_couleur;
        $couleurIndex->id_forme_montre = $request->id_forme_montre;
        $couleurIndex->id_index = $request->id_index;

        if($request->file('image_couleur_index')) {
            //Suppression de l'ancien fichier
            $file_name = "uploads/couleur_index/".$couleurIndex->image_couleur_index;
            File::delete($file_name);

            $image_file = $request->file('image_couleur_index');
            $image_couleur_index = date("YmdHis").".".$image_file->getClientOriginalExtension();
            $image_file->move('uploads/couleur_index', $image_couleur_index);
            $couleurIndex->image_couleur_index = $image_couleur_index;

        }    
        $couleurIndex->save();

        return redirect()->route('couleur_index.index')
               ->with('success','CouleurIndex modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CouleurIndex  $couleurIndex
     * @return \Illuminate\Http\Response
     */
    public function destroy(CouleurIndex $couleurIndex)
    {
        //
         //Suppression de l'ancien fichier
         $file_name = "uploads/couleur_index/".$couleurIndex->image_couleur_index;
         File::delete($file_name);
        $couleurIndex->delete();
        return redirect()->route('couleur_index.index')
               ->with('success','CouleurIndex supprimé avec succès');
    }
}
