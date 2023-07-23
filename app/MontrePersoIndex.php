<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MontrePersoIndex extends Model
{
    //
    protected $primaryKey = 'id_index';
    protected $guarded = [];
    
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'montre_perso_index';

    

        /**
     * Get the CouleurIndex that owns the MontrePersoIndex.
     */
    public function couleurIndexs()
    {
        return $this->hasMany('App\CouleurIndex','id_index');
    }



}
