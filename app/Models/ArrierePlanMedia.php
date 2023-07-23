<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArrierePlanMedia extends Model
{
     /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'guysolamour_arriere_plans_media';

    protected $primaryKey = 'id_arriere_plan_media';

    protected $fillable = [
        'nom',
        'chemin',
        'id_arriere_plan'
    ];
}
