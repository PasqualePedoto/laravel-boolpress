<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use App\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0;$i < 10; $i++){
            $new_user = new User();

            $new_user->name = $faker->firstName();
            $new_user->email = $faker->email();
            $new_user->password = bcrypt('password');

            $new_user->save();
        }
    }
}
