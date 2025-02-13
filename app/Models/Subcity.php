<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function sites(): HasMany
    {
        return $this->hasMany(Sites::class, 'subcity_id');
    }
}
