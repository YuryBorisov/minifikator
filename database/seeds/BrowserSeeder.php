<?php

use Illuminate\Database\Seeder;
use App\Models\Browser;

class BrowserSeeder extends Seeder
{

    public function run(){

        Browser::truncate();

        Browser::insert([
            ['name' => 'Firefox'],
            ['name' => 'Opera'],
            ['name' => 'Chrome'],
            ['name' => 'Internet Explorer'],
            ['name' => 'Safari'],
            ['name' => 'Other']
        ]);

    }
}
