<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'photo',
        'summary',
        'is_parent',
        'parent_id',
        'status'
    ];

    public static function shiftChild($category_id){
        return Category::whereIn('id', $category_id)->update(['is_parent' => 1]);
    }
}
