<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImagePerso extends Model
{
    //
    protected $primaryKey = 'id_image_perso';
    protected $guarded = [];
    
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'image_perso';

    

        /**
     * Get the HorlogeClient that owns the ImagePerso.
     */
    public function horlogeClients()
    {
        return $this->hasMany('App\HorlogeClient','id_image_perso');
    }


    /**
     * Get the MontreClient that owns the ImagePerso.
     */
    public function montreClients()
    {
        return $this->hasMany('App\MontreClient','id_image_perso');
    }



}
