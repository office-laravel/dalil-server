<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageMe extends Model
{
    use HasFactory;


    protected $table = 'page_me';
    protected $fillable = ['page_name' , 'href' , 'users_id'];

    public function user(){
        return $this->belongsTo(User::class,'users_id');
    }

}
