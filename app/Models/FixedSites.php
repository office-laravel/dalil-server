<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedSites extends Model
{
    use HasFactory;

    protected $fillable = ['site_name' , 'href'  , 'photo' , 'country_id' , 'show_status'];

    public function country(){

        return $this->belongsTo(Countries::class , 'country_id');
    }

}
