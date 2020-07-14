<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'properties';
    protected $fillable = ['guid', 'suburb', 'state', 'country'];

    public function analyticTypes()
    {
        return $this->belongsToMany('App\Models\Property', 'property_analytics')->withPivot('value');
    }
}
