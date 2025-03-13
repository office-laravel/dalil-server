<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Package extends Model
{
    use HasFactory;
    protected $table = 'packages';

    protected $fillable = [
        'name',
        'code',
        'href',
        'category',
        'title',
        'logo',
        'mobile_number',
        'phone_number',
        'video',
        'description',
        'articale',
        'subcategories',
        'keyword',
        'social',
        'android',
        'ios',
        'views',
        'priority',
        'maploc',
        'city',
        'sites_count',
        'products_count',
        'price',
        'is_free',
        'status',
    ];
    protected $hidden = ['expire_date'];

    public function packagesusers(): HasMany
    {
        return $this->hasMany(PackageUser::class, 'package_id');
    }
    public function durationspackages(): HasMany
    {
        return $this->hasMany(DurationPackage::class, 'package_id');
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
