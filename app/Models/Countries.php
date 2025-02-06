<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;

    protected $fillable = ['country_name' , 'country_flag' , 'keyword', 'href'  , 'title', 'meta_descr'];

    public function category(){
        return $this->hasMany(Category::class , 'country_id');
    }
    public function sites(){
        return $this->hasMany(Sites::class , 'countries_id');
    }
    public function fixedsite(){
        return $this->hasMany(FixedSites::class , 'country_id');
    }


}
