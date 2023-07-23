<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TailleCadran extends Model
{
    //
    protected $primaryKey = 'id_taille_cadran';
    protected $guarded = [];
    
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'taille_cadran';

    

        /**
     * Get the MontreClient that owns the TailleCadran.
     */
    public function montreClients()
    {
        return $this->hasMany('App\MontreClient','id_taille_cadran');
    }



}
