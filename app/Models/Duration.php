<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Duration extends Model
{
    use HasFactory;
    protected $table = 'durations';

    protected $fillable = [
        'duration',
        'status',

    ];
    //  protected $appends = ['type_conv'];

    public function packagesusers(): HasMany
    {
        return $this->hasMany(PackageUser::class, 'package_id');
    }

    public function durationspackages(): HasMany
    {
        return $this->hasMany(DurationPackage::class, 'duration_id');
    }
    public function packageuserduration(): HasMany
    {
        //جدول Duration وجدول PackageUser الرابط duration_id
        return $this->hasMany(PackageUser::class, 'duration_id');
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
