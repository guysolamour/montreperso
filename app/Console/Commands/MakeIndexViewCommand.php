<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Pluralizer;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

class MakeIndexViewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MakeIndexView {name} {--G|generate} {--D|delete}';

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
        $path = $this->getSourceFilePath('index');

        // Création du répertoire du fichier(class)  si inexistant 
        $this->makeDirectory(dirname($path));
        // Récupération du contenu du fichier complet modifié
        $contents = $this->getSourceFile();
    
        // // Création (écriture) finale du fichier (class) sur le disque dur
        // if (!$this->file->exists($path)) {
        //     $this->file->put($path, $contents);
        //     $this->info("File : {$path} created");
        // } else {
        //     $this->info("File : {$path} already exits");
        // }

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
        return __DIR__ . '/../../../stubs/views/index.stub'; 
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
            '{{class}}' => $this->getClassName($this->argument('name')), 
            '{{model}}' => $this->getClassName($this->argument('name')),
            '{{modelVariable}}' => lcfirst($this->getClassName($this->argument('name'))),
            '{{indexViewContent}}' => $this->indexViewContent($this->argument('name')),
            '{{table_name}}' => $this->argument('name'),
            
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
    public function getSourceFilePath($filename)
    {
        return base_path('resources\\views') .'\\' .$this->getClassName($this->argument('name')) .'\\'. $filename.'.blade.php';
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
    protected function indexViewContent($table_name)
    {
        $primaryKey= $this->getPrimaryKey($table_name);
        $storeMethodCode ="";
        //Le modèle de la Classe
        $model = $this->getClassName($this->argument('name'));
         //La variable générée par le modèle
        $modelVariable = lcfirst($model);
        $modelVarPlural = $modelVariable."s";
        //Liste des colonnes de la table
        $query =  sprintf("show columns from %s", $table_name);
        $table_columns = DB::select($query);

        $table_columns = collect($table_columns); 
        $filtered  = $table_columns->where('Key','<>','PRI');
        
        //Préparation de l'entête de la table
         $storeMethodCode.=  "    <table class=\"table table-bordered\">
         <tr>
             <th>No</th>".PHP_EOL;
        
        foreach($filtered as $item){
            $storeMethodCode .= "        "."<th>".$item->Field." </th>".PHP_EOL;
        }
        $storeMethodCode.=  "        <th width=\"280px\">Action</th> ".PHP_EOL;
        $storeMethodCode.=  "    </tr>".PHP_EOL;
        //Fin Préparation de l'entête de la table

        //Préparation du contenu de la table
        $storeMethodCode .="        @foreach (\$$modelVarPlural as \$$modelVariable)
        <tr>
            <td>{{ ++\$i }}</td>";

            foreach($filtered as $item){
                $storeMethodCode .= "            <td>{{ \$$modelVariable -> $item->Field }}</td> ".PHP_EOL;
            }

            $storeMethodCode.=  "            <td>
            <form action=\"{{ route('$table_name.destroy',\$$modelVariable -> $primaryKey) }}\" method=\"POST\"  id=\"deleteform{{\$i}}\">
 
                <a class=\"btn btn-primary\" href=\"{{ route('$table_name.edit',\$$modelVariable -> $primaryKey) }}\">Modifier</a>
 
                @csrf
                @method('DELETE')
    
                <a class=\"btn btn-danger\" href=\"#\"
                onclick=\"
                        event.preventDefault(); 
                        if (confirm('Etes vous sûr de supprimer l\'enregistrement ?')){
                            document.getElementById('deleteform{{\$i}}').submit()
                        }
                  \" 
                >Supprimer</a>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! \$$modelVarPlural -> links() !!}
";
        
        //Fin Préparation du contenu de la table
        
      
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

        $compactVarsCode ="compact(";

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

                $storeMethodCode .="        "."$"."query =  'SELECT * FROM ".$table." ; ' ;".PHP_EOL;
                // 
                $storeMethodCode .="        "."$".$tableModelVarPlural." = DB::select("."$"."query);".PHP_EOL;
                $compactVarsCode .="'".$tableModelVarPlural."',";

            }

        }
        $compactVarsCode .=")";

        $storeMethodCode .= "        "."return "."view('".$model.".create',".$compactVarsCode.");";
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
        
        foreach($filtered as $item){
            $storeMethodCode .= "        "."$".$modelVariable."->".$item->Field." = ". "$"."request->".$item->Field.";".PHP_EOL;
        }

        $storeMethodCode.="        "."$".$modelVariable."->save();".PHP_EOL.PHP_EOL;
       
        $storeMethodCode .= "        "."return "."redirect()->route('".$table_name.".index')".PHP_EOL;
        $storeMethodCode .= "        "."       "."->with('success','".$model." created   successfully');";


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
              
        $showMethodCode .= "return "."view('".$model.".show',compact('".$modelVariable."'));";

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
         $updateMethodCode.="$".$modelVariable."="." new ".$model."();".PHP_EOL;
        //Liste des colonnes de la table
        $query =  sprintf("show columns from %s", $table_name);
        $table_columns = DB::select($query);

        $table_columns = collect($table_columns); 
        $filtered  = $table_columns->where('Key','<>','PRI');
        
        foreach($filtered as $item){
            $updateMethodCode .= "        "."$".$modelVariable."->".$item->Field." = ". "$"."request->".$item->Field.";".PHP_EOL;
        }

        $updateMethodCode.="        "."$".$modelVariable."->save();".PHP_EOL.PHP_EOL;
       
        $updateMethodCode .= "        "."return "."redirect()->route('".$table_name.".index')".PHP_EOL;
        $updateMethodCode .= "        "."       "."->with('success','".$model." updated  successfully');";



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
        $deleteMethodCode .= "        "."       "."->with('success','".$model." deleted successfully');";

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
    
}
