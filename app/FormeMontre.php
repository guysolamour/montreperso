<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormeMontre extends Model
{
    //
    protected $primaryKey = 'id_forme_montre';
    protected $guarded = [];
    
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'forme_montre';

    

        /**
     * Get the MontreClient that owns the FormeMontre.
     */
    public function montreClients()
    {
        return $this->hasMany('App\MontreClient','id_forme_montre');
    }



}
