<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['admin'];
    protected $table = 'orders_guest';
    protected $fillable =
    [
        'name',
        'id_site',
        'description',
        'facebook',
        'telegram',
        'twitter',
        'instagram',
        'snapchat',
        'youtube',
        'LinkedIn',
        'is_approve',
    ];
}
