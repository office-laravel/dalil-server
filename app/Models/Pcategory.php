<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Pcategory extends Model
{
    use HasFactory;

    protected $table = 'p_categories';

    protected $fillable = [
        'name',
        'description',
        'image',
        'status',
        'parent_id',

    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_p_id');
    }

}
