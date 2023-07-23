<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HorlogeClient extends Model
{
    //
    protected $primaryKey = 'id_horloge_client';
    protected $guarded = [];
    
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'horloge_client';

        /**
     * Get the TexteHorloge that owns the HorlogeClient.
     */
    public function texteHorloge()
    {
        return $this->belongsTo('App\TexteHorloge','id_texte_horloge');
    }


    /**
     * Get the CouleurIndex that owns the HorlogeClient.
     */
    public function couleurIndex()
    {
        return $this->belongsTo('App\CouleurIndex','id_couleur_index');
    }


    /**
     * Get the ArrierePlanHorloge that owns the HorlogeClient.
     */
    public function arrierePlanHorloge()
    {
        return $this->belongsTo('App\ArrierePlanHorloge','id_arriere_plan');
    }


    /**
     * Get the User that owns the HorlogeClient.
     */
    public function user()
    {
        return $this->belongsTo('App\User','id_user');
    }


    /**
     * Get the ImagePerso that owns the HorlogeClient.
     */
    public function imagePerso()
    {
        return $this->belongsTo('App\ImagePerso','id_image_perso');
    }


    /**
     * Get the FormeHorloge that owns the HorlogeClient.
     */
    public function formeHorloge()
    {
        return $this->belongsTo('App\FormeHorloge','id_forme_horloge');
    }


    /**
     * Get the PositionImagePerso that owns the HorlogeClient.
     */
    public function positionImagePerso()
    {
        return $this->belongsTo('App\PositionImagePerso','id_position_image_perso');
    }




    
}
