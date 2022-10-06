<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Mail\PostPublicationMail;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Preleviamo la categoria selezionata che è passata nella query string, per questo
        // è chiamata query
        $category_id = $request->query('category_id');

        // Definiamo la query base per prelevare i posts
        $query = Post::orderBy('updated_at','DESC')->orderBy('created_at','DESC');

        // Ternario che determina se filtrare o meno in base alla presenza del category_id
        $posts = $category_id ? $query->where('category_id',$category_id)->paginate(10) : $query->paginate(10);

        // Preleviamo tutte le categorie
        $categories = Category::all();

        // Passiamo il dato alla vista per mantenere selected la option scelta
        $selected_category = $category_id;
        
        return view('admin.posts.index',compact('posts','categories','selected_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $categories = Category::all();
        $tags = Tag::select('id','label')->get();

        return view('admin.posts.create',compact('post','tags','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:posts',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            'tags' => 'nullable|exists:tags,id',
            'is_published' => 'boolean'
        ],[
            'title.required' => 'Il titolo è un campo obbligatorio',
            'title.string' => 'Il titolo deve essere composta da caratteri',
            'title.content' => 'Il content deve essere composta da caratteri',
            'image.mimes' => 'L\'immagine deve avere estensione: jpg, png o jpeg',
        ]);

        $data = $request->all();

        $new_post = new Post();

        $new_post->fill($data);

        $new_post->slug = Str::slug($new_post->title,'-');

        if(array_key_exists('is_published',$data)) $new_post->is_published = true;
        else $new_post->is_published = false;

        if(array_key_exists('category_id',$data)) $new_post->category_id = $data['category_id'];

        if(array_key_exists('image',$data)){
            $image_link = Storage::put('posts_image',$data['image']);
            $new_post->image = $image_link;
        } 

        $new_post->user_id = Auth::id();

        $new_post->save();

        if($new_post->is_published){
            $mail = new PostPublicationMail($new_post);
            $receiver = Auth::user()->email;
            Mail::to($receiver)->send($mail);
        }

        if(array_key_exists('tags',$data)) $new_post->tags()->attach($data['tags']);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::select('id','label')->get();
        $categories = Category::all();
        $prev_tags = $post->tags->pluck('id')->toArray();

        return view('admin.posts.create',compact('post','tags','prev_tags','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['required','string',Rule::unique('posts')->ignore($post->id)],
            'content' => 'nullable|string',
            'image' => 'nullable',
            'is_published' => 'boolean'
        ],[
            'title.required' => 'Il titolo è un campo obbligatorio',
            'title.string' => 'Il titolo deve essere composta da caratteri',
            'title.content' => 'Il content deve essere composta da caratteri',
        ]);

        $data = $request->all();

        if(array_key_exists('my_post',$data)) $post->user_id = Auth::id();

        if(array_key_exists('is_published',$data)) $post->is_published = true;
        else $post->is_published = false;

        if(array_key_exists('category_id',$data)) $post->category_id = $data['category_id'];

        if(array_key_exists('image',$data)){
            if($post->image) Storage::delete($post->image);
            $image_link = Storage::put('posts_image',$data['image']);
            $post->image = $image_link;
        }

        if(array_key_exists('tags',$data)){
            $post->tags()->sync($data['tags']);
        }else{
            $post->tags()->detach();
        }

        $post->update($data);

        return redirect()->route('admin.posts.show',compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->image) Storage::delete($post->image);

        $post->delete();
        
        return redirect()->route('admin.posts.index');
    }
}
