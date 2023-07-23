<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PositionImagePerso extends Model
{
    //
    protected $primaryKey = 'id_position_image_perso';
    protected $guarded = [];
    
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'position_image_perso';

    

        /**
     * Get the HorlogeClient that owns the PositionImagePerso.
     */
    public function horlogeClients()
    {
        return $this->hasMany('App\HorlogeClient','id_position_image_perso');
    }


    /**
     * Get the MontreClient that owns the PositionImagePerso.
     */
    public function montreClients()
    {
        return $this->hasMany('App\MontreClient','id_position_image_perso');
    }



}
