<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TexteMontre extends Model
{
    //
    protected $primaryKey = 'id_texte_montre';
    protected $guarded = [];
    
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'texte_montre';

    

        /**
     * Get the MontreClient that owns the TexteMontre.
     */
    public function montreClients()
    {
        return $this->hasMany('App\MontreClient','id_texte_montre');
    }



}
