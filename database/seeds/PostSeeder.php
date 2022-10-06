<?php

use Illuminate\Database\Seeder;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 10; $i++){
            $new_post = new Post();

            $tag_ids = Tag::pluck('id')->toArray();
            $categories_ids = Category::pluck('id')->toArray();
            $users_ids = User::pluck('id')->toArray();

            $new_post->title = $faker->sentence();
            $new_post->slug = Str::slug($new_post->title,'-');
            $new_post->is_published = $faker->boolean();
            $new_post->user_id = Arr::random($users_ids);
            $new_post->content = $faker->paragraph(2);
            $new_post->image = $faker->word('animals',true);
            $new_post->category_id = Arr::random($categories_ids);

            $new_post->save();

            $post_tags = [];

            foreach($tag_ids as $tag){
                if($faker->boolean()) $post_tags[] = $tag;
            }

            $new_post->tags()->attach($post_tags);
        }
    }
}
