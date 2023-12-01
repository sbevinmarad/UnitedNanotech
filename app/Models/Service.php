<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'text',
        'price',
        'active'
    ];

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucwords($name);
    }
}
