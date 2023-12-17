<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Url;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class UrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        Url::truncate();
        for($i=1; $i <= 5; $i++){
            $user = new Url();
            $user->user_id = 1;
            $user->slug = generateRandomNumber(10);
            $user->original_url = 'https://youtube.com/';
            $user->generated_url = Str::random(8);
            $user->visit_count = 0;
            $user->save();
        }
    }
}
