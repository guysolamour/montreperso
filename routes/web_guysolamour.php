<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

Route::namespace('Guysolamour')->group(function(){

    Route::post('enregister-montre-client', 'WatchController@enregistrerMontre')->name('enregister_montre_client');
    Route::post('user/login', 'AuthController@authenticate')->name('user.login');
    Route::post('user/register', 'AuthController@register')->name('user.register');



    Route::middleware(['auth'])->prefix('tableau-de-board')->group(function () {
        Route::get('', 'DashboardController@index')->name('user.dashboard');
        Route::get('montres', 'DashboardController@montres')->name('user.dashboard.watch');
        Route::get('montres/{montre}/edit', 'DashboardController@edit')->name('user.dashboard.watch.update');
        Route::put('montres/{montre}/edit', 'DashboardController@update')->name('user.dashboard.watch.update');
    });
});

##### LOGIN #####

Route::get('filldb', function(){
    // dd('salut');

    // Storage::files()

    // for ($i=1; $i < 7; $i++) {
    //     \App\Models\Aiguille::create([
    //         'nom'    => "aiguille{$i}",
    //         'chemin' => "/uploads/guysolamour/aiguilles/aiguille{$i}.png"
    //     ]);
    // }

    // \App\Models\Forme::create([
    //     'nom'    => "ronde.png",
    //     'chemin' => "/uploads/guysolamour/formes/ronde.png"
    // ]);

    // \App\Models\Forme::create([
    //     'nom'    => "carre.png",
    //     'chemin' => "/uploads/guysolamour/formes/carre.png"
    // ]);

    // foreach (['chiffres', 'romains', 'simples', 'vierges'] as $chiffre ) {

    //     \App\Models\Index::create([
    //         'nom'    => $chiffre,
    //     ]);
    // }

    // for ($i=1; $i < 3; $i++){
    //     \App\Models\IndexMedia::create([
    //         'nom'        => $nom = "carre_simple{$i}.png",
    //         'chemin'     => "/uploads/guysolamour/index/$nom",
    //         'index_id'   => 6,
    //     ]);
    // }

    // \App\Models\IndexMedia::get()->each(function(Model $item){

    //     $nom = Str::before($item->nom, '.');

    //     $item->update(['nom' => $nom]);

    //     // dd(Str::before($item->nom, '.'));
    // });

//     $items = \App\Models\ArrierePlanMedia::get()->filter(function(Model $item){
// return Str::contains($item->nom, 'simple');
//     });

//     $items->each(function(Model $item){

//         $item->update(['id_arriere_plan' => 11]);
//     });


    // dd($items->pluck('nom'));




    dd('done');
});
