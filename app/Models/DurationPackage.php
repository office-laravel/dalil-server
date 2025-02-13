<?php

namespace App\Models;

use Facade\Ignition\Support\Packagist\Package;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class DurationPackage extends Model
{
    use HasFactory;
    protected $table = 'durations_packages';

    protected $fillable = [
        'duration_id',
        'package_id',
        'status',
        'price',
    ];
    //  protected $appends = ['type_conv'];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
    public function duration(): BelongsTo
    {
        return $this->belongsTo(Duration::class, 'duration_id');
    }

    // public function getTypeConvAttribute()
    // {
    //     $conv = "";
    //     switch ($this->type) {
    //         case ('p'):
    //             $conv = 'منتج';
    //             break;
    //         case ('s'):
    //             $conv = 'خدمة';
    //             break;

    //         default:
    //             $conv = 'منتج';
    //     }
    //     return $conv;
    // }

}
