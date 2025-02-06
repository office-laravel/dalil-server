<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedSiteNews extends Model
{
    use HasFactory;
    
    protected $table = 'fixed_sites_news';

    protected $fillable = ['name','link' , 'img'];
}
