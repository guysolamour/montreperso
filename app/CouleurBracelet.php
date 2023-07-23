<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouleurBracelet extends Model
{
    //
    protected $primaryKey = 'id_couleur_bracelet';
    protected $guarded = [];
    
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'couleur_bracelet';

    

    
}
