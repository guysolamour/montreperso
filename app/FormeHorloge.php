<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormeHorloge extends Model
{
    //
    protected $primaryKey = 'id_forme_horloge';
    protected $guarded = [];
    
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'forme_horloge';

    

        /**
     * Get the HorlogeClient that owns the FormeHorloge.
     */
    public function horlogeClients()
    {
        return $this->hasMany('App\HorlogeClient','id_forme_horloge');
    }



}
