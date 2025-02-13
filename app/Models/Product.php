<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'name',
        'type',
        'description',
        'image',
        'price',
        'unit',
        'status',
        'sequence',
        'tag',
        'site_id',
        'user_id',
        'category_p_id',
        'currency',

    ];
    protected $appends = ['type_conv'];
    public function site(): BelongsTo
    {
        return $this->belongsTo(Sites::class, 'site_id');
    }
    public function categoryp(): BelongsTo
    {
        return $this->belongsTo(Pcategory::class, 'category_p_id');
    }

    public function getTypeConvAttribute()
    {
        $conv = "";
        switch ($this->type) {
            case ('p'):
                $conv = 'منتج';
                break;
            case ('s'):
                $conv = 'خدمة';
                break;

            default:
                $conv = 'منتج';
        }
        return $conv;
    }

}
