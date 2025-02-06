<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinnedPages extends Model
{
    use HasFactory;
    protected $table = 'pinned_pages';

    protected $fillable = ['page_name' , 'href' , 'title' , 'keyword' , 'content' , 'photo'];

}
