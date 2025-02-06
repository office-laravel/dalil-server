<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sites_tag extends Model
{
    use HasFactory;

    protected $table = 'sites_tag';

    protected $fillable = ['sites_id' , 'tag_id'];

    public $timestamps=false;

}
