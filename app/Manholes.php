<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Manholes extends Model {


    protected $connection = 'mysql2';


    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'manholes';
    
    protected $fillable = [
          'feat_num',
          'name',
          'district',
          'subdistrict',
          'address',
          'latitude',
          'longitude',
          'description',
          'num_entries'
    ];
    

    public static function boot()
    {
        parent::boot();

        Manholes::observe(new UserActionsObserver);
    }
    
    
    
    
}