<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TexteHorloge extends Model
{
    //
    protected $primaryKey = 'id_texte_horloge';
    protected $guarded = [];
    
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'texte_horloge';

    

        /**
     * Get the HorlogeClient that owns the TexteHorloge.
     */
    public function horlogeClients()
    {
        return $this->hasMany('App\HorlogeClient','id_texte_horloge');
    }



}
