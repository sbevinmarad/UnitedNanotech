<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'active'
    ];

    public function products()
    {
        return $this->hasMany(Product::class)->where('active', 1);
    }

    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class)->where('active', 1);
    }
}
