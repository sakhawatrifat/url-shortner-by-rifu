<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Faker\Generator as Faker;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $user = Admin::where('email', 'admin@gmail.com')->first();
        if (is_null($user)) {
            $user = new Admin();
            $user->name = "Admin";
            $user->email = "admin@gmail.com";
            $user->password = bcrypt('admin@0000');
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();
        }
    }
}
