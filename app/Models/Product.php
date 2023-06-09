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

    public function related_products()
    {
        return $this->hasMany('\App\Models\Product', 'category_id', 'category_id')->where(['status' => 'active'])->limit(10);
    }

    public static function getProductByCart($id)
    {
        return self::where('id', $id)->get()->toArray();
    }
}
