<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalyticType extends Model
{
    protected $table = 'analytic_types';
    protected $fillable = ['name', 'units', 'is_numeric', 'num_decimal_places'];
    protected $casts = [
        'is_numeric' => 'boolean',
        'num_decimal_places' => 'integer'
    ];

    public function properties()
    {
        return $this->belongsToMany('App\Property', 'property_analytics');
    }
}
