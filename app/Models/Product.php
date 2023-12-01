<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'sub_category_id',
        'name',
        'slug',
        'description',
        'image',
        'text',
        'price',
        'gst_amount',
        'price_with_gst',
        'packaging_type',
        'packaging_size',
        'file',
        'is_hot_item',
        'is_popular',
        'is_featured',
        'gst',
        'active'
    ];

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucwords($name);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function latestImage()
    {
        return $this->hasOne(ProductImage::class)->latest();
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class)->latest();
    }

    public function productFiles()
    {
        return $this->hasMany(ProductFile::class)->latest();
    }

    
}
