<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcity extends Model
{
    use HasFactory;

    protected $table = 'subcities';
    protected $fillable = [
        'city_id',
        'subname',
        'href',
        'latitude',
        'longitude',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
