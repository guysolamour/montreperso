<?php

namespace App\Http\Controllers;

use App\Police;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PoliceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $polices = Police::latest()->paginate(5);

        return view('Police.index',compact('polices'))
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
        return view('Police.create');
    }

     /**
     * Show the form for upolad a new police.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_upload_police()
    {
        //
         return view('Police.create_upload_police');
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_import(Request $request)
    {
        // 1. Validation du fichier uploadé. Extension ".xlsx" autorisée
        $this->validate($request, [
            'fichier' => 'bail|required|file|mimes:xlsx'
        ]);

        // 2. On déplace le fichier uploadé vers le dossier "public" pour le lire
        $file_new_name = $request->fichier->hashName();
        $fichier = $request->fichier->move('uploads/fichiers_excels', $file_new_name);
        //dd($file_new_name);
        
        //import des données dans un tableau de collection
        $data = fastexcel()->import("uploads/fichiers_excels/".$file_new_name);
        foreach($data as $item){
            $police= new Police();
            $police->valeur_police = $item['Police'];
            // $police->valeur_anglaise = $request->valeur_anglaise;
            $police->save();
        }
    //	
        
        return redirect()->route('police.index')
               ->with('success','Police créé avec succès');
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
        $police= new Police();
        $police->valeur_police = $request->valeur_police;
        $police->valeur_anglaise = $request->valeur_anglaise;
        $police->save();

        return redirect()->route('police.index')
               ->with('success','Police créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Police  $police
     * @return \Illuminate\Http\Response
     */
    public function show(Police $police)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Police  $police
     * @return \Illuminate\Http\Response
     */
    public function edit(Police $police)
    {
        //
                return view('Police.edit',compact('police'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Police  $police
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Police $police)
    {
        //
                $police->valeur_police = $request->valeur_police;
        $police->valeur_anglaise = $request->valeur_anglaise;
        $police->save();

        return redirect()->route('police.index')
               ->with('success','Police modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Police  $police
     * @return \Illuminate\Http\Response
     */
    public function destroy(Police $police)
    {
        //
        $police->delete();
        return redirect()->route('police.index')
               ->with('success','Police supprimé avec succès');
    }
}
