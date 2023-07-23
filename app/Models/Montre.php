<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Montre extends Model
{
    protected $primaryKey = 'id_montre_client';

    protected $fillable = [
        'nom', 'bracelet', 'id_forme', 'id_index', 'id_index_image', 'id_aiguille',
        'id_arriere_plan', 'id_arriere_plan_image', 'id_user', 'texte_fond', 'image_fond'
    ];

    /**
     * image_fond = ['image', 'taille', 'positionX', 'positionY']
     * texte_fond = ['texte', 'taille', 'positionX', 'positionY', 'couleur', 'police']
     */

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'guysolamour_montres';

    // protected $casts = [
    //     // 'image_fond'      => 'array',
    //     // 'texte_fond'      => 'array'
    // ];


    public function setTexteFondAttribute($value)
    {
        $value = is_array($value) ? json_encode($value) : $value;

        $this->attributes['texte_fond'] = $value;
    }

    public function setImageFondAttribute($value)
    {
        $value = is_array($value) ? json_encode($value) : $value;

        $this->attributes['image_fond'] = $value;
    }
    public function setBraceletAttribute($value)
    {
        $value = is_array($value) ? json_encode($value) : $value;

        $this->attributes['bracelet'] = $value;
    }

    public function getTexteFondAttribute()
    {
        return json_decode($this->attributes['texte_fond'], true);
    }

    public function getImageFondAttribute()
    {
        return json_decode($this->attributes['image_fond'], true);
    }

    public function getBraceletAttribute()
    {
        return json_decode($this->attributes['bracelet'], true);
    }


    public function forme()
    {
        return $this->belongsTo(Forme::class, 'id_forme');
    }

    public function index()
    {
        return $this->belongsTo(Index::class, 'id_index');
    }

    public function indexImage()
    {
        return $this->belongsTo(IndexMedia::class, 'id_index_image');
    }

    public function aiguille()
    {
        return $this->belongsTo(Aiguille::class, 'id_aiguille');
    }

    public function arrierePlan()
    {
        return $this->belongsTo(ArrierePlan::class, 'id_arriere_plan');
    }

    public function arrierePlanImage()
    {
        return $this->belongsTo(ArrierePlanMedia::class, 'id_arriere_plan_image');
    }

    /**
     * Get the User that owns the MontreClient.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}

