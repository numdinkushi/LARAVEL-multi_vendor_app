<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'stock',
        'price',
        'summary',
        'offer_price',
        'discount',
        'conditions',
        'status',
        'photo',
        'vendor_id',
        'category_id',
        'child_category_id',
        'size',
        'brand_id'
    ];

    public function brand()
    {
        return $this->belongsTo('\App\Models\Brand', 'category_id', 'id');
    }

}
