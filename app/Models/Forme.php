<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forme extends Model
{
     /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'guysolamour_formes';

    protected $primaryKey = 'id_forme';

    protected $fillable = [
        'nom',
        'chemin'
    ];


    public function index()
    {
        return $this->hasMany(Index::class, 'forme_id');
    }
}
