<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndexMedia extends Model
{
     /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'guysolamour_index_media';

    protected $primaryKey = 'id_index_media';

    protected $fillable = [
        'nom',
        'chemin',
        'index_id'
    ];
}
