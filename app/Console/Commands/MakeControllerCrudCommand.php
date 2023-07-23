<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Pluralizer;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

class MakeControllerCrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ControllerCrud {name} {--G|generate} {--D|delete}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the crud of selected project according to the database';

    /**file
     * Filesystem instance
     * @var Filesystem
     */
    protected $file;

    /**
     * Create a new command instance.
     * @param Filesystem $file
     */
    public function __construct(Filesystem $file)
    {
        parent::__construct();

        $this->file = $file;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Récupération de toutes les tables 
        // $tables = DB::select('SHOW TABLES');
        // foreach ($tables as $table) {
        //     foreach ($table as $key => $value)
        //         // echo $value .'<br>';
        //         Artisan::call("make:model $value --controller ");
        // }

        // Retrieve a specific option...
        $generateOption = $this->option('generate');
        $deleteOption = $this->option('delete');
        
        // Création (composition) du nom du fichier (class) à créer 
        $path = $this->getSourceFilePath();

        // Création du répertoire du fichier(class)  si inexistant 
        $this->makeDirectory(dirname($path));
        // Récupération du contenu du fichier complet modifié
        $contents = $this->getSourceFile();
        if($generateOption && $deleteOption == null)
        {    // Création (écriture) finale du fichier (class) sur le disque dur
            if (!$this->file->exists($path)) {
                $this->file->put($path, $contents);
                $this->info("File : {$path} créé");
            } else {
                $this->info("File : {$path} already exits");
            }
        }

        if($deleteOption && $generateOption == null)
        {    // Suppression du fichier (class) sur le disque dur
            if ($this->file->exists($path)) {
                $this->file->delete($path);
                $this->info("File : {$path} deleted");
            } else {
                $this->info("File : {$path} doesn't exits");
            }
        }

        return 0;
    }

    /** 
    * Renvoie le nom en majuscule singulier 
    * @param $name 
    * @return string 
    */ 
    public function getClassName($name) 
    { 
        //On partage les différents segments de la chaîne
        $MyVar = explode("_",$name);
        $ClassName = "";
        //on convertit les premières lettre  de chaque segment en majuscule
        foreach($MyVar as $var){
            $ClassName .= ucwords($var);
        }
        // return ucwords(Pluralizer:: singular ($name)); 
         return $ClassName; 
    }

    /** 
    * Renvoie le chemin du fichier stub 
    * @return string 
    * 
    */ 
    public function getStubPath() 
    { 
        return __DIR__ . '/../../../stubs/controller.stub'; 
    }


    /** 
    ** 
    * Mappez les variables de stub présentes dans stub à sa valeur 
    * 
    * @return array 
    * 
    */ 
    public function getStubVariables() 
    { 
        return [ 
            // 'NAMESPACE' => 'App\\Interfaces', 
            '{{class}}' => $this->getClassName($this->argument('name')), 
            '{{model}}' => $this->getClassName($this->argument('name')),
            '{{modelVariable}}' => lcfirst($this->getClassName($this->argument('name'))),
            '{{indexMethodContent}}' => $this->indexMethodContent($this->argument('name')),
            '{{createMethodContent}}' => $this->createMethodContent($this->argument('name')),
            '{{storeMethodContent}}' => $this->storeMethodContent($this->argument('name')),
            '{{showMethodContent}}' => $this->showMethodContent($this->getClassName($this->argument('name'))),
            '{{editMethodContent}}' => $this->editMethodContent($this->getClassName($this->argument('name'))),
            '{{updateMethodContent}}' => $this->updateMethodContent($this->argument('name')),
            '{{deleteMethodContent}}' => $this->deleteMethodContent($this->argument('name')),
            
        ] ; 
    }

    /**
     * Get the stub path and the stub variables
     *
     * @return bool|mixed|string
     *
     */
    public function getSourceFile()
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }


    /**
     * Replace the stub variables(key) with the desire value
     *
     * @param $stub
     * @param array $stubVariables
     * @return bool|mixed|string
     */
    public function getStubContents($stub , $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace)
        {
            $contents = str_replace($search , $replace, $contents);
        }

        return $contents;

    }

    /**
     * Get the full path of generated class
     *
     * @return string
     */
    public function getSourceFilePath()
    {
        return base_path('App\\Http\\Controllers') .'\\' .$this->getClassName($this->argument('name')) . 'Controller.php';
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (! $this->file->isDirectory($path)) {
            $this->file->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

    /**
     * Build the realted code  
     * for the laravel Controller index method
     *
     * @param  string  $storeMethodCode
     * @return string
     */
    protected function indexMethodContent($table_name)
    {

        $storeMethodCode ="";
        //Le modèle de la Classe
        $model = $this->getClassName($this->argument('name'));
         //La variable générée par le modèle
         $modelVariable = lcfirst($this->getClassName($this->argument('name')));
         $modelVariablePlural = $modelVariable."s";
         $storeMethodCode.="$".$modelVariablePlural." = ".$model."::latest()->paginate(5);".PHP_EOL.PHP_EOL;
        
       
        $storeMethodCode.="        "."return "."view('".$model.".index',compact('".$modelVariablePlural."'))".PHP_EOL;
        $storeMethodCode.="                  "."->with('i', (request()->input('page', 1) - 1) * 5);";

        return $storeMethodCode;
    }

    /**
     * Build the realted code  
     * for the laravel Controller create method
     *
     * @param  string  $storeMethodCode
     * @return string
     */
    protected function  createMethodContent($table_name)
    {
        $storeMethodCode ="";
        //Le modèle de la Classe
        $model = $this->getClassName($this->argument('name'));

       

        /////////NOUVEAUX CODES
        $tables_parents = $this->getReferenced_Table_Names($this->argument('name'));
       // dd()
       if(sizeof($tables_parents) > 1){
            $compactVarsCode ="compact(";
            foreach($tables_parents as $tableName){

                $table = $tableName->REFERENCED_TABLE_NAME;
                if($table !=null){
                    //Le modèle de la Classe
                    // $tableModel = $this->getClassName($table);
                    //La variable générée par le modèle
                    $tableModelVar = lcfirst($this->getClassName($table));
                    $tableModelVarPlural = $tableModelVar."s";

                    $storeMethodCode .=" "."$"."query =  'SELECT * FROM ".$table." ; ' ;".PHP_EOL;
                    // 
                    $storeMethodCode .="        "."$".$tableModelVarPlural." = DB::select("."$"."query);".PHP_EOL;
                    $compactVarsCode .="'".$tableModelVarPlural."',";

                }

            }
            $compactVarsCode .=")";

            $storeMethodCode .= "        "."return "."view('".$model.".create',".$compactVarsCode.");";
        }
        else {
            $storeMethodCode .= "        "."return "."view('".$model.".create');";

        }
       
        /////////FIN NOUVEAUX CODES
       
              
        //$storeMethodCode .= "return "."view('".$model.".create');";

        return $storeMethodCode;
    }

    /**
     * Build the realted code to store a new object value
     * for the laravel Controller store method
     *
     * @param  string  $storeMethodCode
     * @return string
     */
    protected function storeMethodContent($table_name)
    {

        $storeMethodCode ="";
        //Le modèle de la Classe
        $model = $this->getClassName($this->argument('name'));
         //La variable générée par le modèle
         $modelVariable = lcfirst($this->getClassName($this->argument('name')));
         $storeMethodCode.="$".$modelVariable."="." new ".$model."();".PHP_EOL;
        //Liste des colonnes de la table
        $query =  sprintf("show columns from %s", $table_name);
        $table_columns = DB::select($query);

        $table_columns = collect($table_columns); 
        $filtered  = $table_columns->where('Key','<>','PRI');
        
        // foreach($filtered as $item){
        //     $storeMethodCode .= "        "."$".$modelVariable."->".$item->Field." = ". "$"."request->".$item->Field.";".PHP_EOL;
        // }

        $fk_colomns[] ="created_at";
        $fk_colomns[] ="updated_at";
        
        foreach($filtered as $item){
              //On vérifie si la colonne n'est pas dans le tableau des colonnes interditent
              if(!in_array($item->Field, $fk_colomns)){
                  $storeMethodCode .= "        "."$".$modelVariable."->".$item->Field." = ". "$"."request->".$item->Field.";".PHP_EOL;
              }
        }

        $storeMethodCode.="        "."$".$modelVariable."->save();".PHP_EOL.PHP_EOL;
       
        $storeMethodCode .= "        "."return "."redirect()->route('".$table_name.".index')".PHP_EOL;
        $storeMethodCode .= "        "."       "."->with('success','".$model." créé avec succès');";

        return $storeMethodCode;
    }

    /**
     * Build the realted code  
     * for the laravel Controller show method
     *
     * @param  string  $showMethodCode
     * @return string
     */
    protected function  showMethodContent($table_name)
    {
        $showMethodCode ="";
        //Le modèle de la Classe
        $model = $this->getClassName($this->argument('name'));
        //La variable générée par le modèle
        $modelVariable = lcfirst($model);
              
        // $showMethodCode .= "return "."view('".$model.".show',compact('".$modelVariable."'));";

        return $showMethodCode;
    }


    /**
     * Build the realted code  
     * for the laravel Controller show method
     *
     * @param  string  $editMethodCode
     * @return string
     */
    protected function  editMethodContent($table_name)
    {
        $editMethodCode ="";
        
        //Le modèle de la Classe
        $model = $this->getClassName($this->argument('name'));
        //La variable générée par le modèle
        $modelVariable = lcfirst($model);
        $compactVarsCode ="compact('".$modelVariable."'";

        /////////NOUVEAUX CODES
        $tables_parents = $this->getReferenced_Table_Names($this->argument('name'));
       // dd()
        foreach($tables_parents as $tableName){

            $table = $tableName->REFERENCED_TABLE_NAME;
            if($table !=null){
                //Le modèle de la Classe
                // $tableModel = $this->getClassName($table);
                //La variable générée par le modèle
                $tableModelVar = lcfirst($this->getClassName($table));
                $tableModelVarPlural = $tableModelVar."s";

                $editMethodCode .="        "."$"."query =  'SELECT * FROM ".$table." ; ' ;".PHP_EOL;
                // 
                $editMethodCode .="        "."$".$tableModelVarPlural." = DB::select("."$"."query);".PHP_EOL;
                $compactVarsCode .=","."'".$tableModelVarPlural."'";

            }

        }
        $compactVarsCode .=")";

        $editMethodCode .= "        "."return "."view('".$model.".edit',".$compactVarsCode.");";
        /////////FIN NOUVEAUX CODES
              
        // $editMethodCode .= "return "."view('".$model.".edit',compact('".$modelVariable."'));";

        return $editMethodCode;
    }

    /**
     * Build the realted code to update a new object value
     * for the laravel Controller update method
     *
     * @param  string  $updateMethodCode
     * @return string
     */
    protected function updateMethodContent($table_name)
    {

        $updateMethodCode ="";
        //Le modèle de la Classe
        $model = $this->getClassName($this->argument('name'));
         //La variable générée par le modèle
         $modelVariable = lcfirst($this->getClassName($this->argument('name')));
        //  $updateMethodCode.="$".$modelVariable."="." new ".$model."();".PHP_EOL;
        //Liste des colonnes de la table
        $query =  sprintf("show columns from %s", $table_name);
        $table_columns = DB::select($query);

        $table_columns = collect($table_columns); 
        $filtered  = $table_columns->where('Key','<>','PRI');

        $fk_colomns[] ="created_at";
        $fk_colomns[] ="updated_at";
        
        foreach($filtered as $item){
              //On vérifie si la colonne n'est pas dans le tableau des colonnes interditent
              if(!in_array($item->Field, $fk_colomns)){
                  $updateMethodCode .= "        "."$".$modelVariable."->".$item->Field." = ". "$"."request->".$item->Field.";".PHP_EOL;
              }
        }

        $updateMethodCode.="        "."$".$modelVariable."->save();".PHP_EOL.PHP_EOL;
       
        $updateMethodCode .= "        "."return "."redirect()->route('".$table_name.".index')".PHP_EOL;
        $updateMethodCode .= "        "."       "."->with('success','".$model." modifié avec succès');";



        return $updateMethodCode;
    }

    /**
     * Build the realted code  
     * for the laravel Controller show method
     *
     * @param  string  $deleteMethodCode
     * @return string
     */
    protected function  deleteMethodContent($table_name)
    {
        $deleteMethodCode ="";
        //Le modèle de la Classe
        $model = $this->getClassName($this->argument('name'));
        //La variable générée par le modèle
        $modelVariable = lcfirst($model);
        $deleteMethodCode .="$".$modelVariable ."->delete();".PHP_EOL;
        $deleteMethodCode .= "        "."return "."redirect()->route('".$table_name.".index')".PHP_EOL;
        $deleteMethodCode .= "        "."       "."->with('success','".$model." supprimé avec succès');";

        return $deleteMethodCode;
    }

    /**
     * The Referenced Table Names for the foreign keys.
     *
     * @param  string  $table_name
     * @return array $Referenced_Table_Names 
     */
    protected function getReferenced_Table_Names($table_name)
    {

        //Table parent de notre table
        $query =  sprintf("SELECT TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE  TABLE_NAME ='%s'; ", $table_name);
        $query_result = DB::select($query);
        $Referenced_Table_Names = $query_result;

        return $Referenced_Table_Names ;
    }
    
}
