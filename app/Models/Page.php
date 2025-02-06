<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['page_name' , 'href' , 'page_content' , 'category_id'];

    // public function category(){
    //     return $this->belongsTo(Category::class , 'category_id');
    // }
}



