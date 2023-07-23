<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestHorlogeClient1 extends Model
{
    //
    protected $primaryKey = 'id';
    protected $guarded = [];
    
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'test_horloge_client1';

    //protected $REFERENCED_TABLE_NAME = '{{REFERENCED_TABLE_NAME}}';

        /**
     * Get the HorlogeClient that owns the TestHorlogeClient1.
     */
    public function horlogeClient()
    {
        return $this->belongsTo('App\HorlogeClient','id_horloge_client');
    }




    
}
