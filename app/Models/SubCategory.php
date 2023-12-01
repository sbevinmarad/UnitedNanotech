<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table ='sub_categories';

    protected $fillable = [
        'name',
        'category_id',
        'slug',
        'image',
        'active'
    ];

    public function products()
    {
        return $this->hasMany(Product::class)->where('active', 1);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
