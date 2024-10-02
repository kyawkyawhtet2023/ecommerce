<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('app_profiles')->insert([
            'name' => 'Default Profile',
            'day_image' => 'day_image_url.jpg',
            'night_image' => 'night_image_url.jpg',
            'background_image' => 'background_image_url.jpg',
            'primary' => '#FFFFFF',
            'secondary' => '#000000',
            'name_color' => '#FF5733',
            'title_color' => '#C70039',
            'price_color' => '#900C3F',
            'body_color' => '#581845',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
