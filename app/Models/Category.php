<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'status'
    ];

    // cate có nhiều prod
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function relatedProducts()
    {
        return $this->hasMany(Product::class, 'category_id', 'id')->latest();
    }
}
