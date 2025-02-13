<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sites extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'sites';
    protected $fillable = [
        'site_name',
        'href',
        'category_id',
        'title',
        'logo',
        'mobile_number',
        'phone_number',
        'video',
        'description',
        'articale',
        'subcategories',
        'countries_id',
        'cities_id',
        'keyword',
        // 'tag_id',
        'facebook',
        'twitter',
        'instagram',
        'snapchat',
        'youtube',
        'telegram',
        'LinkedIn',
        'android',
        'ios',
        'views',
        'priority',
        'confirmed',
        'latitude',
        'longitude',
        'city_id',
        'subcity_id',
        'user_id',
        'package_user_id',
        'used_products_count',

    ];
    /**
     * Get the user that owns the Sites
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'subcategories');
    }
    public function country(): BelongsTo
    {
        return $this->belongsTo(Countries::class, 'countries_id');
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function subcity(): BelongsTo
    {
        return $this->belongsTo(Subcity::class, 'subcity_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'site_id');
    }
    public function packageuser(): BelongsTo
    {
        return $this->belongsTo(PackageUser::class, 'package_user_id');
    }

}
