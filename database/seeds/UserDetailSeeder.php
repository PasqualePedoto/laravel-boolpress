<?php

use Illuminate\Database\Seeder;
use App\Models\UserDetail;
use App\User;
use Faker\Generator as Faker;

class UserDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = User::all();

        foreach($users as $user){
            $new_details = new UserDetail();
            $new_details->user_id = $user->id;
            $new_details->first_name = $faker->firstName();
            $new_details->last_name = $faker->lastName();
            $new_details->year_of_birth = $faker->year();
            $new_details->address = $faker->address();

            $new_details->save();
        }
    }
}
