<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsGallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'cms_id',
        'banner_text',
        'banner_sub_title',
        'banner',
        'banner_description',
        'file_type',
        'active'
    ];
}
