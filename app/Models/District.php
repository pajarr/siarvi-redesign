<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use SoftDeletes;
    
    protected $table = 'districts';

    protected $fillable = [
        'province_id',
        'city_id',
        'name',
        'place_code',
        'longitude',
        'latitude',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
