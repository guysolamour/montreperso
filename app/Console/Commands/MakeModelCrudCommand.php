<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Pluralizer;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

class MakeModelCrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ModelCrud {table_name}  {--G|generate} {--D|delete}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the crud of selected project according to the database';

    /**
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
                $this->info("File : {$path} created");
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
    
        // Création (écriture) finale du fichier (class) sur le disque dur
        // if (!$this->file->exists($path)) {
        //     $this->file->put($path, $contents);
        //     $this->info("File : {$path} created");
        // } else {
        //     $this->info("File : {$path} already exits");
        // }

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
        return __DIR__ . '/../../../stubs/model.stub'; 
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
            '{{class}}' => $this->getClassName($this->argument('table_name')), 
            '{{model}}' => $this->getClassName($this->argument('table_name')),
            '{{primaryKey}}' => $this->getPrimaryKey($this->argument('table_name')),
            '{{table}}' => $this->argument('table_name'),
            '{{modelVariable}}' => lcfirst($this->getClassName($this->argument('table_name'))),
            // '{{REFERENCED_TABLE_NAME}}' => $this->getReferenced_Table_Names(($this->argument('table_name'))),
            '{{parentRelationShips}}' => $this->parentRelationShips($this->argument('table_name')),
            '{{childrenRelationShips}}' => $this->childrenRelationShips($this->argument('table_name')),
           
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
        // return base_path('App\\Http\\Controllers') .'\\' .$this->getClassName($this->argument('table_name')) . 'Controller.php';
        return base_path('App') .'\\' .$this->getClassName($this->argument('table_name')) . '.php';
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
     * The primary key associated with the table.
     *
     * @param  string  $table_name
     * @return string $primaryKey 
     */
    protected function getPrimaryKey($table_name)
    {

        //Clé primaire de la table
        $query =  sprintf(" SHOW KEYS FROM %s WHERE Key_name = 'PRIMARY' ", $table_name);
        $query_result = DB::select($query);
        $primaryKey = $query_result[0]->Column_name;

        return $primaryKey ;
    }

        
    /**
     * The Referenced Table Names for the foreign keys.
     *
     * @param  string  $table_name
     * @return array $Referenced_Table_Names 
     */
    protected function getReferenced_Table_Names($table_name)
    {

        //Clé primaire de la table
        $query =  sprintf("SELECT TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE  TABLE_NAME ='%s'; ", $table_name);
        $query_result = DB::select($query);
        $Referenced_Table_Names = $query_result;

        return $Referenced_Table_Names ;
    }

    
    
    /**
     * The Referenced Table Names for the foreign keys.
     *
     * @param  string  $table_name
     * @return array $Referenced_Table_Names 
     */
    protected function parentRelationShips($table_name)
    {
        $model = $this->getClassName($this->argument('table_name'));
        $parentRelationsCode ="";
        
        //The Referenced Table Names for the foreign keys.
        $query =  sprintf("SELECT TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE  TABLE_NAME ='%s'; ", $table_name);
        $query_result = DB::select($query);
        $Referenced_Table_Names = $query_result;

        foreach($Referenced_Table_Names as $tableName){
            
            $table = $tableName->REFERENCED_TABLE_NAME;
            $tableKey = $tableName->REFERENCED_COLUMN_NAME;
            if($table !=null){
                //Le modèle de la Classe
                $tableModel = $this->getClassName($table);
                //La variable générée par le modèle
                $tableModelVariable = lcfirst($tableModel);

                $parentRelationsCode .="    /"."**".PHP_EOL;
                $parentRelationsCode .="     * Get the ".$tableModel." that owns the ".$model.".".PHP_EOL;
                $parentRelationsCode .="     */".PHP_EOL;
                $parentRelationsCode .="    public function ".$tableModelVariable."()".PHP_EOL;
                $parentRelationsCode .="    {".PHP_EOL;
                $parentRelationsCode .="        return "."$"."this->belongsTo('App\\".$tableModel."','".$tableKey."');".PHP_EOL;
                $parentRelationsCode .="    }".PHP_EOL;
                $parentRelationsCode .=PHP_EOL.PHP_EOL;
            }
            
            

        }


        return $parentRelationsCode ;
    }

    /**
     * The Referenced Table Names for the primary keys.
     *
     * @param  string  $table_name
     * @return array $Referenced_Table_Names 
     */
    protected function childrenRelationShips($table_name)
    {
        $model = $this->getClassName($this->argument('table_name'));
        $parentRelationsCode ="";
        
        //The Referenced Table Names for the foreign keys.
        $query =  sprintf("SELECT TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE  REFERENCED_TABLE_NAME ='%s'; ", $table_name);
        $query_result = DB::select($query);
        $Referenced_Table_Names = $query_result;

        foreach($Referenced_Table_Names as $tableName){
            
            $table = $tableName->TABLE_NAME;
            //La clé primaire 
            $tableParentKey = $tableName->REFERENCED_COLUMN_NAME;
            if($table !=null){
                //Le modèle de la Classe
                $tableModel = $this->getClassName($table);
                //La variable générée par le modèle
                $tableModelVariable = lcfirst($tableModel);

                $parentRelationsCode .="    /"."**".PHP_EOL;
                $parentRelationsCode .="     * Get the ".$tableModel." that owns the ".$model.".".PHP_EOL;
                $parentRelationsCode .="     */".PHP_EOL;
                $parentRelationsCode .="    public function ".$tableModelVariable."s"."()".PHP_EOL;
                $parentRelationsCode .="    {".PHP_EOL;
                $parentRelationsCode .="        return "."$"."this->hasMany('App\\".$tableModel."','".$tableParentKey."');".PHP_EOL;
                $parentRelationsCode .="    }".PHP_EOL;
                $parentRelationsCode .=PHP_EOL.PHP_EOL;
            }
            
            

        }


        return $parentRelationsCode ;
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
        $model = $this->getClassName($this->argument('table_name'));
         //La variable générée par le modèle
         $modelVariable = lcfirst($this->getClassName($this->argument('table_name')));
         $modelVariablePlural = $modelVariable."s";
         $storeMethodCode.="$".$modelVariablePlural." = ".$model."::latest()->paginate(5);".PHP_EOL.PHP_EOL;
        
       
        $storeMethodCode.="        "."return "."view('".$model.".index',compact('".$modelVariablePlural."'))".PHP_EOL;
        $storeMethodCode.="                  "."->with('i', (request()->input('page', 1) - 1) * 5);";

        return $storeMethodCode;
    }

}
