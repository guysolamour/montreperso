<?php

namespace App\Http\Controllers;

use App\CouleurIndex;
use App\MontreClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MontreClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $montreClients = MontreClient::latest()->paginate(5);

        return view('MontreClient.index',compact('montreClients'))
                  ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create2()
    {
        //
       $query =  'SELECT * FROM arriere_plan_montre ; ' ;
       $arrierePlanMontres = DB::select($query);
       $query =  'SELECT * FROM position_image_perso ; ' ;
              $positionImagePersos = DB::select($query);
       $query =  'SELECT * FROM forme_montre ; ' ;
              $formeMontres = DB::select($query);

       $couleurIndexs = CouleurIndex::get();

       $query =  'SELECT * FROM image_perso ; ' ;
              $imagePersos = DB::select($query);
       $query =  'SELECT * FROM taille_cadran ; ' ;
              $tailleCadrans = DB::select($query);
       $query =  'SELECT * FROM texte_montre ; ' ;
              $texteMontres = DB::select($query);
       $query =  'SELECT * FROM user ; ' ;
        $users = DB::select($query);

        $query =  'SELECT * FROM police ; ' ;
        $polices = DB::select($query);

        // auth()->logout();

        return view('MontreClient.create',compact('arrierePlanMontres','positionImagePersos','formeMontres','couleurIndexs','imagePersos','tailleCadrans','texteMontres','users','polices'));

    }
    public function create()
    {
    //     $formes = \App\Models\Forme::with(['index', 'index.images'])->get();
    //    dd($formes);

        // auth()->logout();

        return view('MontreClient.create');
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
        $montreClient= new MontreClient();
        $montreClient->id_forme_montre = $request->id_forme_montre;
        $montreClient->id_taille_cadran = $request->id_taille_cadran;
        $montreClient->id_couleur_index = $request->id_couleur_index;
        $montreClient->id_texte_montre = $request->id_texte_montre;
        $montreClient->id_image_perso = $request->id_image_perso;
        $montreClient->id_position_image_perso = $request->id_position_image_perso;
        $montreClient->id_arriere_plan = $request->id_arriere_plan;
        $montreClient->quantite = $request->quantite;
        $montreClient->prix = $request->prix;
        $montreClient->id_user = $request->id_user;
        $montreClient->save();


        return redirect()->route('montre_client.index')
               ->with('success','MontreClient créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MontreClient  $montreClient
     * @return \Illuminate\Http\Response
     */
    public function show(MontreClient $montreClient)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MontreClient  $montreClient
     * @return \Illuminate\Http\Response
     */
    public function edit(MontreClient $montreClient)
    {
        //
                $query =  'SELECT * FROM arriere_plan_montre ; ' ;
        $arrierePlanMontres = DB::select($query);
        $query =  'SELECT * FROM position_image_perso ; ' ;
        $positionImagePersos = DB::select($query);
        $query =  'SELECT * FROM forme_montre ; ' ;
        $formeMontres = DB::select($query);
        $query =  'SELECT * FROM couleur_index ; ' ;
        $couleurIndexs = DB::select($query);
        $query =  'SELECT * FROM image_perso ; ' ;
        $imagePersos = DB::select($query);
        $query =  'SELECT * FROM taille_cadran ; ' ;
        $tailleCadrans = DB::select($query);
        $query =  'SELECT * FROM texte_montre ; ' ;
        $texteMontres = DB::select($query);
        $query =  'SELECT * FROM user ; ' ;
        $users = DB::select($query);
        return view('MontreClient.edit',compact('montreClient','arrierePlanMontres','positionImagePersos','formeMontres','couleurIndexs','imagePersos','tailleCadrans','texteMontres','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MontreClient  $montreClient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MontreClient $montreClient)
    {
        //
                $montreClient->id_forme_montre = $request->id_forme_montre;
        $montreClient->id_taille_cadran = $request->id_taille_cadran;
        $montreClient->id_couleur_index = $request->id_couleur_index;
        $montreClient->id_texte_montre = $request->id_texte_montre;
        $montreClient->id_image_perso = $request->id_image_perso;
        $montreClient->id_position_image_perso = $request->id_position_image_perso;
        $montreClient->id_arriere_plan = $request->id_arriere_plan;
        $montreClient->quantite = $request->quantite;
        $montreClient->prix = $request->prix;
        $montreClient->id_user = $request->id_user;
        $montreClient->save();

        return redirect()->route('montre_client.index')
               ->with('success','MontreClient modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MontreClient  $montreClient
     * @return \Illuminate\Http\Response
     */
    public function destroy(MontreClient $montreClient)
    {
        //
        $montreClient->delete();
        return redirect()->route('montre_client.index')
               ->with('success','MontreClient supprimé avec succès');
    }
}
