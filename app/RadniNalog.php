<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class RadniNalog extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'radninalog';
    
    protected $fillable = [
          'user_id',
          'manholes_id'
    ];
    

    public static function boot()
    {
        parent::boot();

        RadniNalog::observe(new UserActionsObserver);
    }
    
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }


    public function manholes()
    {
        return $this->hasOne('App\Manholes', 'id', 'manholes_id');
    }


    
    
    
}