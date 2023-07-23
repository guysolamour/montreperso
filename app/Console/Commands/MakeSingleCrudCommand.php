<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

class MakeSingleCrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MakeSingleCrud {table_name} {--G|generate} {--D|delete} ';

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

        // Retrieve a specific option...
        $generateOption = $this->option('generate');
        $deleteOption = $this->option('delete');
        $table_name = $this->argument('table_name');
        // Récupération de toutes les tables 
        $tables = DB::select('SHOW TABLES');
        $nbTables = count($tables);

    
// GENERATION DES DIFFERENTS OBJETS POUR LE CRUD
        if($generateOption && $deleteOption == null)
        {    

             // Création des models
            $this->info("Creating Model file for $table_name");

            Artisan::call("ModelCrud $table_name --generate");

            // Création des Controllers
            $this->info("");
            $this->info("Creating Controller file for $table_name");

            Artisan::call("ControllerCrud $table_name --generate ");


            // Création des differentes vues
            $this->info("");
            $this->info("Creating view file for $table_name");

            Artisan::call("MakeIndexView $table_name  --generate");
            Artisan::call("MakeCreateView $table_name  --generate");
            Artisan::call("MakeEditView $table_name --generate ");
        
            
        }
// SUPPRESSION DES DIFFERENTS OBJETS GENERES
        if($deleteOption && $generateOption == null)
        {    

             // Suppression des models
            $this->info("Deleting Model file for $table_name");

            Artisan::call("ModelCrud $table_name --delete");
            // Suppression des Controllers
            $this->info("");
            $this->info("Suppression Controller file for $table_name");

            Artisan::call("ControllerCrud $table_name --delete ");

            // Suppression des differentes vues
            $this->info("");
            $this->info("Deleting views file for $table_name");

            Artisan::call("MakeIndexView $table_name  --delete");
            Artisan::call("MakeCreateView $table_name  --delete");
            Artisan::call("MakeEditView $table_name --delete ");

        }


       
        //   // Création du répertoire d'upload de chaque table 
        // foreach ($tables as $table) {
        //     foreach ($table as $key => $table_name){
        //         $modelName = $this->getClassName($table_name);
        //         $directoryName = base_path("public\\uploads\\$modelName");
        //         //$NewdirectoryName = base_path("public\\uploads\\$table_name");
        //         $this->makeDirectory($directoryName);
        //         //rename($directoryName,$NewdirectoryName);
        //         //$this->makeDirectory($directoryName);
        //     }
        // }
        //  //Fin Création des differents répertoire
      
     

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
        return __DIR__ . '/../../../stubs/views/layout.stub'; 
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
            // '{{class}}' => $this->getClassName($this->argument('name')), 
            // '{{model}}' => $this->getClassName($this->argument('name')),
            // '{{modelVariable}}' => lcfirst($this->getClassName($this->argument('name'))),
            // '{{indexMethodContent}}' => $this->indexMethodContent($this->argument('name')),
            // '{{createMethodContent}}' => $this->createMethodContent($this->argument('name')),
            // '{{storeMethodContent}}' => $this->storeMethodContent($this->argument('name')),
            // '{{showMethodContent}}' => $this->showMethodContent($this->getClassName($this->argument('name'))),
            // '{{editMethodContent}}' => $this->editMethodContent($this->getClassName($this->argument('name'))),
            // '{{updateMethodContent}}' => $this->updateMethodContent($this->argument('name')),
            // '{{deleteMethodContent}}' => $this->deleteMethodContent($this->argument('name')),
            
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
        return $this->getStubContents($this->getStubPath());
    }


    /**
     * Replace the stub variables(key) with the desire value
     *
     * @param $stub
     * @param array $stubVariables
     * @return bool|mixed|string
     */
    public function getStubContents($stub)
    {
        $contents = file_get_contents($stub);

        // foreach ($stubVariables as $search => $replace)
        // {
        //     $contents = str_replace($search , $replace, $contents);
        // }

        return $contents;

    }

    /**
     * Get the full path of generated class
     *
     * @return string
     */
    public function getSourceFilePath($filename)
    {
        return base_path('resources\\views') .'\\' . $filename.'.blade.php';
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

    

  
}
