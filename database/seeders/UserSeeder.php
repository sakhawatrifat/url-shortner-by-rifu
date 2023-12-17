<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $user = User::where('email', 'user@gmail.com')->first();
        if (is_null($user)) {
            $user = new User();
            $user->name = "Default User";
            $user->email = "user@gmail.com";
            $user->password = bcrypt('user@0000');
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();
        }
    }
}
