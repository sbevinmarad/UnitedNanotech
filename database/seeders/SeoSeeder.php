<?php

namespace Database\Seeders;

use App\Models\Seo;
use Illuminate\Database\Seeder;

class SeoSeeder extends Seeder
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
                'name' => 'Home',
                'title' => 'Home',
                'slug' => 'home',
            ],
            [
                'name' => 'Vision Statement',
                'title' => 'Vision Statement',
                'slug' => 'vision-statement',
            ],
            [
                'name' => 'Mission Statement',
                'title' => 'Mission Statement',
                'slug' => 'mission-statement',
            ],
            [
                'name' => 'Founder Message',
                'title' => 'Founder Message',
                'slug' => 'founder-message',
            ],
            [
                'name' => 'Our Team',
                'title' => 'Our Team',
                'slug' => 'our-team',
            ],
            [
                'name' => 'Our Clients',
                'title' => 'Our Clients',
                'slug' => 'our-clients',
            ],
            [
                'name' => 'Our Presence',
                'title' => 'Our Presence',
                'slug' => 'our-presence',
            ],
            [
                'name' => 'Products',
                'title' => 'Products',
                'slug' => 'products',
            ],
            [
                'name' => 'Infrastructure',
                'title' => 'Infrastructure',
                'slug' => 'infrastructure',
            ],
            [
                'name' => 'Gallery',
                'title' => 'Gallery',
                'slug' => 'gallery',
            ],
            [
                'name' => 'Carrer',
                'title' => 'Carrer',
                'slug' => 'carrer',
            ],
            [
                'name' => 'Terms and Conditions',
                'title' => 'Terms and Conditions',
                'slug' => 'terms-and-conditions',
            ],
            [
                'name' => 'Material',
                'title' => 'Material',
                'slug' => 'material',
            ],
            [
                'name' => 'Testimonials',
                'title' => 'Testimonials',
                'slug' => 'testimonials',
            ],
            [
                'name' => 'Contact Us',
                'title' => 'Contact Us',
                'slug' => 'contact-us',
            ],
            
        ];
        foreach ($datas as $data) {
            Seo::create($data);
        }
    }
}
