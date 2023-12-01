<?php

namespace Database\Seeders;
use App\Models\Cms;
use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
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
                'title' => 'Home',
                'slug' => 'home',
            ],
            [
                'title' => 'About Us',
                'slug' => 'about-us',
            ],
            [
                'title' => 'Vision Statement',
                'slug' => 'vision-statement',
            ],
            [
                'title' => 'Mission Statement',
                'slug' => 'mission-statement',
            ],
            [
                'title' => 'Founder Message',
                'slug' => 'founder-message',
            ],
            [
                'title' => 'Our Team',
                'slug' => 'our-team',
            ],
            [
                'title' => 'Our Clients',
                'slug' => 'our-clients',
            ],
            [
                'title' => 'Our Presence',
                'slug' => 'our-presence',
            ],
            [
                'title' => 'Products',
                'slug' => 'products',
            ],
            [
                'title' => 'Infrastructure',
                'slug' => 'infrastructure',
            ],
            [
                'title' => 'Gallery',
                'slug' => 'gallery',
            ],
            [
                'title' => 'Carrer',
                'slug' => 'carrer',
            ],
            [
                'title' => 'Terms and Conditions',
                'slug' => 'terms-and-conditions',
            ],
            [
                'title' => 'Material',
                'slug' => 'material',
            ],
            [
                'title' => 'Testimonials',
                'slug' => 'testimonials',
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact-us',
            ],
            
        ];
        foreach ($datas as $data) {
            Cms::create($data);
        }
    }
}
