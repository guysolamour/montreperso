<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Pluralizer;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

class MakeRouteCrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RouteCrud  {--G|generate} {--D|delete}';

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
        $path = base_path('routes\\web.php');
        
        // Création du répertoire du fichier(class)  si inexistant 
        $this->makeDirectory(dirname($path));
        // Récupération du contenu du fichier complet modifié
        $contents = $this->generateRouteCode();
        if($generateOption && $deleteOption == null)
        {    // Création (écriture) finale du fichier (class) sur le disque dur
            if ($this->file->exists($path)) {
                $this->file->append($path, $contents);
                $this->info("Routes added to the web file");
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
                $this->info("File : {$path} doesn't exist");
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
    public function getSourceFilePath($table_name)
    {
        return base_path('App\\Http\\Controllers') .'\\' .$this->getClassName($table_name) . 'Controller.php';
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
     * @param  
     * @return string $generatedRouteCode
     */
    protected function generateRouteCode()
    {

        

        $generatedRouteCode ="".PHP_EOL;
        
        //  Récupération de toutes les tables 
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            foreach ($table as $key => $table_name)
             {
            $controllerName = $this->getClassName($table_name);
              $generatedRouteCode .="Route::resource('$table_name', '$controllerName"."Controller');".PHP_EOL ;
                }
        }

        
        return $generatedRouteCode;
    }
}
