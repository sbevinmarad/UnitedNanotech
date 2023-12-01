<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Cms;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Category;
use App\Models\SocialLink;
use View;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        ini_set('max_execution_time', 3000);
        $contactUs = Cms::where('slug','contact-us')->first();
        $getCategories = Category::with('sub_categories')->withcount('products')->having('products_count', '>', 0)->where('active',1)->orderBy('name')->get();
        $socialLinks = SocialLink::where('active',1)->orderBy('name')->get();
        $siteSetting = Setting::first();
        View::share('contactUs', $contactUs);
        View::share('getCategories', $getCategories);
        View::share('siteSetting', $siteSetting);
        View::share('socialLinks', $socialLinks);
    }
}
