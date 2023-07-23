<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArrierePlanHorloge extends Model
{
    //
    protected $primaryKey = 'id_arriere_plan';
    protected $guarded = [];
    
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'arriere_plan_horloge';

    

        /**
     * Get the HorlogeClient that owns the ArrierePlanHorloge.
     */
    public function horlogeClients()
    {
        return $this->hasMany('App\HorlogeClient','id_arriere_plan');
    }



}
