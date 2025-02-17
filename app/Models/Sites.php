<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;
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
    protected $appends = ['package'];
    public function getPackageAttribute()
    {

        //check count of sites
        $site_id = $this->id;
        $now = Carbon::now();
        $site = Sites::find($site_id);
        $package = new Package();
        if ($site->package_user_id) {
            $packusr = PackageUser::where('id', $site->package_user_id)->whereDate('expire_date', '>=', $now)->first();
            $package->name = $packusr->name;
            $package->href = $packusr->href;
            $package->category = $packusr->category;
            $package->title = $packusr->title;
            $package->logo = $packusr->logo;
            $package->mobile_number = $packusr->mobile_number;
            $package->phone_number = $packusr->phone_number;
            $package->video = $packusr->video;
            $package->description = $packusr->description;
            $package->articale = $packusr->articale;
            $package->subcategories = $packusr->subcategories;
            $package->keyword = $packusr->keyword;
            $package->social = $packusr->social;
            $package->android = $packusr->android;
            $package->ios = $packusr->ios;
            //  $package->priority = isset($formdata['priority']) ? 1 : 0;
            $package->maploc = $packusr->maploc;
            $package->city = $packusr->city;

            $package->sites_count = $packusr->sites_count;
            $package->products_count = $packusr->products_count;
            // $package->price = $formdata['price'];
            $package->is_free = 0;

        } else {
            //free
            $packusr = Package::where('is_free', 1)->orderByDesc('created_at')->first();
            $package->name = $packusr->name;
            $package->href = $packusr->href;
            $package->category = $packusr->category;
            $package->title = $packusr->title;
            $package->logo = $packusr->logo;
            $package->mobile_number = $packusr->mobile_number;
            $package->phone_number = $packusr->phone_number;
            $package->video = $packusr->video;
            $package->description = $packusr->description;
            $package->articale = $packusr->articale;
            $package->subcategories = $packusr->subcategories;
            $package->keyword = $packusr->keyword;
            $package->social = $packusr->social;
            $package->android = $packusr->android;
            $package->ios = $packusr->ios;

            //  $package->priority = isset($formdata['priority']) ? 1 : 0;
            $package->maploc = $packusr->maploc;
            $package->city = $packusr->city;

            $package->sites_count = $packusr->sites_count;
            $package->products_count = $packusr->products_count;
            // $package->price = $formdata['price'];
            $package->is_free = 1;
            //  $isfree = 1;
        }
        $res = 0;

        return $package;

    }
}
