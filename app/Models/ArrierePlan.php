<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArrierePlan extends Model
{
     /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'guysolamour_arriere_plans';

    protected $primaryKey = 'id_arriere_plan';

    protected $fillable = [
        'nom',
        'chemin'
    ];


    public function images()
    {
        return $this->hasMany(ArrierePlanMedia::class, 'id_arriere_plan');
    }
}
