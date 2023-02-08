<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;

class state extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'states';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'name',
                  'country_id',
                  'country_code',
                  'fips_code',
                  'iso2',
                  'type',
                  'latitude',
                  'longitude',
                  'flag',
                  'wikiDataId'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    
    /**
     * Get the country for this model.
     *
     * @return App\Models\Country
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country','country_id');
    }



}
