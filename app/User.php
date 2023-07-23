<?php

namespace App;

use App\Models\Montre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    //
    protected $primaryKey = 'id_user';
    protected $guarded = [];

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['nomComplet'];

    protected $hidden = [
        'password', 'remember_token',
    ];



    public function getNomCompletAttribute()
    {
        return $this->nom . ' ' . $this->prenoms;
    }


    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }



        /**
     * Get the HorlogeClient that owns the User.
     */
    public function horlogeClients()
    {
        return $this->hasMany('App\HorlogeClient','id_user');
    }

        /**
     * Get the HorlogeClient that owns the User.
     */
    public function montres()
    {
        return $this->hasMany(Montre::class,'id_user');
    }


    /**
     * Get the MontreClient that owns the User.
     */
    public function montreClients()
    {
        return $this->hasMany('App\MontreClient','id_user');
    }



}
