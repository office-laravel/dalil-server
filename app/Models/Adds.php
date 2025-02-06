<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adds extends Model
{

    public $table = "adds";
    protected $fillable = [
        "atTop",
        "atRight",
        "otherSite",
        "atHead",
    ];

    protected $hidden = [];
}
