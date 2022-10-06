<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = config('categories');

        foreach($categories as $category){
            $new_category = new Category();

            $new_category->label =  $category['label'];
            $new_category->color =  $category['color'];

            $new_category->save();
        }
    }
}
