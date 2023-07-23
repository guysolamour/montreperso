<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aiguille extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'guysolamour_aiguilles';

    protected $primaryKey = 'id_aiguille';

    protected $fillable = [
        'nom',
        'chemin'
    ];

}
