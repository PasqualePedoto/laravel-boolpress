<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $develop = config('code_language');

       foreach($develop as $dev){
        $new_tag = new Tag();

        $new_tag->label = $dev;
        $new_tag->color = $faker->hexColor();

        $new_tag->save();
       }
    }
}
