<?php

namespace App\Http\Controllers;

use App\HorlogeClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HorlogeClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $horlogeClients = HorlogeClient::latest()->paginate(5);

        return view('HorlogeClient.index',compact('horlogeClients'))
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
          $query =  'SELECT * FROM texte_horloge ; ' ;
        $texteHorloges = DB::select($query);
 $query =  'SELECT * FROM couleur_index ; ' ;
        $couleurIndexs = DB::select($query);
 $query =  'SELECT * FROM arriere_plan_horloge ; ' ;
        $arrierePlanHorloges = DB::select($query);
 $query =  'SELECT * FROM user ; ' ;
        $users = DB::select($query);
 $query =  'SELECT * FROM image_perso ; ' ;
        $imagePersos = DB::select($query);
 $query =  'SELECT * FROM forme_horloge ; ' ;
        $formeHorloges = DB::select($query);
 $query =  'SELECT * FROM position_image_perso ; ' ;
        $positionImagePersos = DB::select($query);
        return view('HorlogeClient.create',compact('texteHorloges','couleurIndexs','arrierePlanHorloges','users','imagePersos','formeHorloges','positionImagePersos',));
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
        $horlogeClient= new HorlogeClient();
        $horlogeClient->id_forme_horloge = $request->id_forme_horloge;
        $horlogeClient->id_taille = $request->id_taille;
        $horlogeClient->id_couleur_index = $request->id_couleur_index;
        $horlogeClient->id_text = $request->id_text;
        $horlogeClient->id_image_perso = $request->id_image_perso;
        $horlogeClient->id_position_image_perso = $request->id_position_image_perso;
        $horlogeClient->id_arriere_plan = $request->id_arriere_plan;
        $horlogeClient->quantite = $request->quantite;
        $horlogeClient->prix = $request->prix;
        $horlogeClient->id_user = $request->id_user;
        $horlogeClient->save();

        return redirect()->route('horloge_client.index')
               ->with('success','HorlogeClient créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HorlogeClient  $horlogeClient
     * @return \Illuminate\Http\Response
     */
    public function show(HorlogeClient $horlogeClient)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HorlogeClient  $horlogeClient
     * @return \Illuminate\Http\Response
     */
    public function edit(HorlogeClient $horlogeClient)
    {
        //
                $query =  'SELECT * FROM texte_horloge ; ' ;
        $texteHorloges = DB::select($query);
        $query =  'SELECT * FROM couleur_index ; ' ;
        $couleurIndexs = DB::select($query);
        $query =  'SELECT * FROM arriere_plan_horloge ; ' ;
        $arrierePlanHorloges = DB::select($query);
        $query =  'SELECT * FROM user ; ' ;
        $users = DB::select($query);
        $query =  'SELECT * FROM image_perso ; ' ;
        $imagePersos = DB::select($query);
        $query =  'SELECT * FROM forme_horloge ; ' ;
        $formeHorloges = DB::select($query);
        $query =  'SELECT * FROM position_image_perso ; ' ;
        $positionImagePersos = DB::select($query);
        return view('HorlogeClient.edit',compact('horlogeClient','texteHorloges','couleurIndexs','arrierePlanHorloges','users','imagePersos','formeHorloges','positionImagePersos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HorlogeClient  $horlogeClient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HorlogeClient $horlogeClient)
    {
        //
                $horlogeClient->id_forme_horloge = $request->id_forme_horloge;
        $horlogeClient->id_taille = $request->id_taille;
        $horlogeClient->id_couleur_index = $request->id_couleur_index;
        $horlogeClient->id_text = $request->id_text;
        $horlogeClient->id_image_perso = $request->id_image_perso;
        $horlogeClient->id_position_image_perso = $request->id_position_image_perso;
        $horlogeClient->id_arriere_plan = $request->id_arriere_plan;
        $horlogeClient->quantite = $request->quantite;
        $horlogeClient->prix = $request->prix;
        $horlogeClient->id_user = $request->id_user;
        $horlogeClient->save();

        return redirect()->route('horloge_client.index')
               ->with('success','HorlogeClient modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HorlogeClient  $horlogeClient
     * @return \Illuminate\Http\Response
     */
    public function destroy(HorlogeClient $horlogeClient)
    {
        //
        $horlogeClient->delete();
        return redirect()->route('horloge_client.index')
               ->with('success','HorlogeClient supprimé avec succès');
    }
}
