<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            
            [
                'page_name' => 'Vision Statement',
                'slug' => 'vision-statement',
            ],
            [
                'page_name' => 'Mission Statement',
                'slug' => 'mission-statement',
            ],
            [
                'page_name' => 'Founder Message',
                'slug' => 'founder-message',
            ],
            [
                'page_name' => 'Our Team',
                'slug' => 'our-team',
            ],
            [
                'page_name' => 'Our Clients',
                'slug' => 'our-clients',
            ],
            [
                'page_name' => 'Our Presence',
                'slug' => 'our-presence',
            ],
            [
                'page_name' => 'Products',
                'slug' => 'products',
            ],
            [
                'page_name' => 'Infrastructure',
                'slug' => 'infrastructure',
            ],
            [
                'page_name' => 'Gallery',
                'slug' => 'gallery',
            ],
            [
                'page_name' => 'Carrer',
                'slug' => 'carrer',
            ],
            [
                'page_name' => 'Terms and Conditions',
                'slug' => 'terms-and-conditions',
            ],
            [
                'page_name' => 'Material',
                'slug' => 'material',
            ],
            [
                'page_name' => 'Testimonials',
                'slug' => 'testimonials',
            ],
            [
                'page_name' => 'Contact Us',
                'slug' => 'contact-us',
            ],
            
        ];
        foreach ($datas as $data) {
            Banner::create($data);
        }
    }
}
