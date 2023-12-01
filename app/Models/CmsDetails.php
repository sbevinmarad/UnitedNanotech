<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'cms_id',
        'title',
        'description',
        'icon',
        'image',
    ];
}
