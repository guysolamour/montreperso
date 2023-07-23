<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\FastExcel\FastExcel; // La classe FastExcel


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
// */

Route::get('/mel_test', function () {
    $data = collect(); // Une collection ou un modèle
        $fastexcel = new FastExcel($data); // L'instance Fast Excel
        dd($fastexcel);
});

Route::get('/', function () {
    // Auth::loginUsingId(2);
    // Auth::logout();
    return view('home');
    // return view('layout');
});

Route::get('/test', function () {
      //Toutes lés étrangères de la table
    //   $tables = DB::select("SELECT TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE  REFERENCED_TABLE_NAME ='horloge_client';");
      $tables = DB::select("SELECT TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE  TABLE_NAME ='horloge_client';");

         //Toutes lés étrangères de la table
    $tables_parents = DB::select("SELECT TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE  TABLE_NAME ='horloge_client';");

    $tables_parents = collect($tables_parents) ;
        $fk_colomns = $tables_parents->pluck('REFERENCED_COLUMN_NAME');
        // dd($fk_colomns);
        $fk_colomns = $fk_colomns->toArray();
        $fk_colomns[] ="created_at";
        $fk_colomns[] ="updated_at";

     dd($fk_colomns);
    //Liste des colonnes de la table
    // $table_columns = DB::select("select column_name from information_schema.columns where table_name='montre_client'");
    $table_columns = DB::select('show columns from montre_client');
   //dd($table_columns);
    $table_columns = collect($table_columns);
    $filtered  = $table_columns->where('Key','<>','PRI');
   // dd($table_columns[0]);
//    dd($filtered);
   foreach($filtered as $item){
    echo '<br>'.$item -> Field;
   }
   exit;

    $tables = DB::select("SELECT * FROM information_schema.table_constraints WHERE table_schema = 'montre_perso' AND table_name='montre_client'; ");
    // dd($tables);

    //liste des tables de la base de données
    $tables = DB::select('SHOW TABLES');
    foreach ($tables as $table) {
        foreach ($table as $key => $value)
            echo $value .'<br>';
    }
    //Clé primaire de la table
    $tables = DB::select(" SHOW KEYS FROM forme_montre WHERE Key_name = 'PRIMARY' ");
    //  dd($tables);
     echo '<br>';
     echo "la clé primaire de ".$tables[0]->Table .'<br>';
     echo " est :".$tables[0]->Column_name;

      //Toutes lés étrangères de la table
    $tables_parents = DB::select("SELECT TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE REFERENCED_TABLE_SCHEMA = 'tontine' AND TABLE_NAME ='retraitclients';");

    $tables_parents = collect($tables_parents) ;
        $fk_colomns = $tables_parents->pluck('REFERENCED_COLUMN_NAME');
        // dd($fk_colomns);
        $fk_colomns = $fk_colomns->toArray();


    });


Route::get('ajax',function() {
    return view('message');
 });


 Route::get('list_index/{id}', 'CouleurIndexController@list_index')->name('list_index');

Route::post('upload_image', 'ImagePersoController@store_image')->name('upload_image');
Route::get('police/import', 'PoliceController@create_upload_police')->name('police.import');
Route::post('police/import', 'PoliceController@store_import')->name('police.store_import');


Route::resource('arriere_plan_horloge', 'ArrierePlanHorlogeController');
Route::resource('arriere_plan_montre', 'ArrierePlanMontreController');
Route::resource('couleur_bracelet', 'CouleurBraceletController');
Route::resource('couleur_index', 'CouleurIndexController');
Route::resource('forme_horloge', 'FormeHorlogeController');
Route::resource('forme_montre', 'FormeMontreController');
Route::resource('horloge_client', 'HorlogeClientController');
Route::resource('image_perso', 'ImagePersoController');
Route::resource('montre_client', 'MontreClientController');
Route::resource('montre_perso_index', 'MontrePersoIndexController');
Route::resource('police', 'PoliceController');
Route::resource('position_image_perso', 'PositionImagePersoController');
Route::resource('position_texte', 'PositionTexteController');
Route::resource('taille_cadran', 'TailleCadranController');
Route::resource('texte_horloge', 'TexteHorlogeController');
Route::resource('texte_montre', 'TexteMontreController');
Route::resource('user', 'UserController');
Route::resource('arriere_plan_horloge', 'ArrierePlanHorlogeController');
Route::resource('arriere_plan_montre', 'ArrierePlanMontreController');
Route::resource('couleur_bracelet', 'CouleurBraceletController');
Route::resource('couleur_index', 'CouleurIndexController');
Route::resource('forme_horloge', 'FormeHorlogeController');
Route::resource('forme_montre', 'FormeMontreController');
Route::resource('horloge_client', 'HorlogeClientController');
Route::resource('image_perso', 'ImagePersoController');
Route::resource('montre_client', 'MontreClientController');
Route::resource('montre_perso_index', 'MontrePersoIndexController');
Route::resource('police', 'PoliceController');
Route::resource('position_image_perso', 'PositionImagePersoController');
Route::resource('position_texte', 'PositionTexteController');
Route::resource('taille_cadran', 'TailleCadranController');
Route::resource('texte_horloge', 'TexteHorlogeController');
Route::resource('texte_montre', 'TexteMontreController');
Route::resource('user', 'UserController');


require_once 'web_guysolamour.php';





