<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Police extends Model
{
    //
    protected $primaryKey = 'id_police';
    protected $guarded = [];
    
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'police';

    

    
}
