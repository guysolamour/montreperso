<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/upload', 'VideoController@index');
Route::post('/test_ajax', 'VideoController@test_ajax');
Route::post('/store', 'VideoController@store');
Route::get('/upload_multiple', 'VideoController@index_upload_multiple');
Route::post('/upload_multiple_files', 'VideoController@upload_multiple_files');

Route::get('/', function () {
$i =1000; $j =5000;
  $a ="


  \$horlogeClient= new HorlogeClient();
  \$horlogeClient->id_forme = \$request->id_forme;


  $$$$$i+$j 

  \$horlogeClient->id_taille = \$request->id_taille;
  \$horlogeClient->id_couleur_index = \$request->id_couleur_index;

  \$horlogeClient->save();
  
  ";
   return $a;
    //return view('welcome');
});

Route::get('/test', function () {
      //Toutes lés étrangères de la table
    //   $tables = DB::select("SELECT TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE  REFERENCED_TABLE_NAME ='horloge_client';");
      $tables = DB::select("SELECT TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE  TABLE_NAME ='forme_montre';");
     dd($tables); 
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
    $tables = DB::select("SELECT TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE REFERENCED_TABLE_SCHEMA = 'tontine' AND TABLE_NAME ='retraitclients';");

   
    });
    

Route::get('ajax',function() {
    return view('message');
 });
 Route::get('/getmsg','AjaxController@index');



