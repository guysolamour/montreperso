<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArrierePlanMontre extends Model
{
    //
    protected $primaryKey = 'id_arriere_plan';
    protected $guarded = [];
    
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'arriere_plan_montre';

    

        /**
     * Get the MontreClient that owns the ArrierePlanMontre.
     */
    public function montreClients()
    {
        return $this->hasMany('App\MontreClient','id_arriere_plan');
    }



}
