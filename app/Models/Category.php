<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $guarded = [];
    protected $fillable = ['category_name', 'href', 'title', 'image', 'keywords', 'parent_id', 'country_id', 'visible_status', 'show_status', 'icon']; // 'parent_id'


    public function supcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');

    }

    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id', 'id');
    }


    public function sites(): HasMany
    {

        return $this->hasMany(Sites::class, 'category_id', 'id');
    }
    // public function pages(): HasMany
    // {

    //     return $this->hasMany(Page::class ,  'category_id' , 'id');
    // }




}
