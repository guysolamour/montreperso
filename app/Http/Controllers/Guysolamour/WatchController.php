<?php

namespace App\Http\Controllers\Guysolamour;

use App\Models\Montre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MontreFormRequest;

/*
    Tables
        guysolamour_aiguilles
        guysolamour_arriere_plans
        guysolamour_couleur_bracelets (pas d'image juste une table qui enregistre les couleurs en string en hexadecimal)
        guysolamour_montre_predefinies

        guysolamour_formes (ronde, carre)
            guysolamour_index_chiffres
            guysolamour_index_romains
            guysolamour_index_simples
            guysolamour_index_vierge




 */

class WatchController extends Controller
{
    public function enregistrerMontre(MontreFormRequest $request)
    {
        // dd($request->all());

        $watch = Montre::create($request->validated());

        return redirect()->route('user.dashboard');
    }
}
