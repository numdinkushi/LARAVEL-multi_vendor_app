<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'product_id',
        'sum_total',
        'total_amount',
        'coupon',
        'delivery_charge',

        'quantity',
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
        'street',
        'address',
        'city',
        'state',
        'postcode',
        'note',

        'shipping_first_name',
        'shipping_last_name',
        'shipping_email',
        'shipping_phone',
        'shipping_country',
        'shipping_street',
        'shipping_address',
        'shipping_city',
        'shipping_state',
        'shipping_postcode',
    ];
}
