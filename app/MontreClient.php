<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MontreClient extends Model
{
    //
    protected $primaryKey = 'id_montre_client';
    protected $guarded = [];
    
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'montre_client';

        /**
     * Get the ArrierePlanMontre that owns the MontreClient.
     */
    public function arrierePlanMontre()
    {
        return $this->belongsTo('App\ArrierePlanMontre','id_arriere_plan');
    }


    /**
     * Get the PositionImagePerso that owns the MontreClient.
     */
    public function positionImagePerso()
    {
        return $this->belongsTo('App\PositionImagePerso','id_position_image_perso');
    }


    /**
     * Get the FormeMontre that owns the MontreClient.
     */
    public function formeMontre()
    {
        return $this->belongsTo('App\FormeMontre','id_forme_montre');
    }


    /**
     * Get the CouleurIndex that owns the MontreClient.
     */
    public function couleurIndex()
    {
        return $this->belongsTo('App\CouleurIndex','id_couleur_index');
    }


    /**
     * Get the ImagePerso that owns the MontreClient.
     */
    public function imagePerso()
    {
        return $this->belongsTo('App\ImagePerso','id_image_perso');
    }


    /**
     * Get the TailleCadran that owns the MontreClient.
     */
    public function tailleCadran()
    {
        return $this->belongsTo('App\TailleCadran','id_taille_cadran');
    }


    /**
     * Get the TexteMontre that owns the MontreClient.
     */
    public function texteMontre()
    {
        return $this->belongsTo('App\TexteMontre','id_texte_montre');
    }


    /**
     * Get the User that owns the MontreClient.
     */
    public function user()
    {
        return $this->belongsTo('App\User','id_user');
    }




    
}
