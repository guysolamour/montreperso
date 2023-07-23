<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouleurIndex extends Model
{
    //
    protected $primaryKey = 'id_couleur_index';
    protected $guarded = [];
    
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'couleur_index';

        /**
     * Get the MontrePersoIndex that owns the CouleurIndex.
     */
    public function montrePersoIndex()
    {
        return $this->belongsTo('App\MontrePersoIndex','id_index');
    }

        /**
     * Get the formeMontre that owns the CouleurIndex.
     */
    public function formeMontre()
    {
        return $this->belongsTo('App\FormeMontre','id_forme_montre');
    }




        /**
     * Get the HorlogeClient that owns the CouleurIndex.
     */
    public function horlogeClients()
    {
        return $this->hasMany('App\HorlogeClient','id_couleur_index');
    }


    /**
     * Get the MontreClient that owns the CouleurIndex.
     */
    public function montreClients()
    {
        return $this->hasMany('App\MontreClient','id_couleur_index');
    }



}
