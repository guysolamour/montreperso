<?php

namespace App\Http\Controllers;

use App\ImagePerso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ImagePersoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $imagePersos = ImagePerso::latest()->paginate(5);

        return view('ImagePerso.index',compact('imagePersos'))
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
                 return view('ImagePerso.create');
    }

    public function store_image(Request $request)
    {
        $request->validate([
            'image_perso' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
        ]);
        if($request->file('image_perso')) {
            $image = $request->file('image_perso');
            $nom_image_perso = date("YmdHis").".".$image->getClientOriginalExtension();
            $image->move('uploads/image_perso', $nom_image_perso);

        //    return  response()->json($nom_image_perso) ;
           return  response()->json(array('image'=> $nom_image_perso), 200);

        }
        //
        // $imagePerso= new ImagePerso();
        // $imagePerso->adresse = $request->adresse;
        // $imagePerso->id_user = $request->id_user;
        // $imagePerso->save();

        return 0;
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
        $imagePerso= new ImagePerso();
        $imagePerso->adresse = $request->adresse;
        $imagePerso->id_user = $request->id_user;
        $imagePerso->save();

        return redirect()->route('image_perso.index')
               ->with('success','ImagePerso créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ImagePerso  $imagePerso
     * @return \Illuminate\Http\Response
     */
    public function show(ImagePerso $imagePerso)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImagePerso  $imagePerso
     * @return \Illuminate\Http\Response
     */
    public function edit(ImagePerso $imagePerso)
    {
        //
                return view('ImagePerso.edit',compact('imagePerso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ImagePerso  $imagePerso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImagePerso $imagePerso)
    {
        //
                $imagePerso->adresse = $request->adresse;
        $imagePerso->id_user = $request->id_user;
        $imagePerso->save();

        return redirect()->route('image_perso.index')
               ->with('success','ImagePerso modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ImagePerso  $imagePerso
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImagePerso $imagePerso)
    {
        //
        $imagePerso->delete();
        return redirect()->route('image_perso.index')
               ->with('success','ImagePerso supprimé avec succès');
    }
}
