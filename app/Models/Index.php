<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Index extends Model
{
     /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'guysolamour_index';

    protected $primaryKey = 'id_index';

    protected $fillable = [
        'nom',
        'description'
    ];

    public function images()
    {
        return $this->hasMany(IndexMedia::class, 'index_id');
    }
}
