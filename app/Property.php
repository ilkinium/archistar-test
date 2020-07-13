<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'properties';
    protected $fillable = ['guid', 'suburb', 'state', 'country'];

    public function analyticTypes()
    {
        return $this->belongsToMany('App\Property', 'property_analytics')->withPivot('value');
    }
}
