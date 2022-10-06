@extends('layouts.app')

@section('content')
    <div class="container">
        @if($post->exists)
            <h1 class="text-center mb-5">Edit post: {{ $post->title }}</h1>
            <form action="{{ route('admin.posts.update',$post) }}" method="POST" class="d-flex flex-wrap" enctype="multipart/form-data">
                @method('PUT')
        @else
            <h1 class="text-center mb-5">Create new post</h1>
            <form action="{{ route('admin.posts.store') }}" method="POST" class="d-flex flex-wrap" enctype="multipart/form-data">
        @endif
            @csrf
                {{-- Title --}}
                <div class="form-group col-6">
                    <label for="title">Title</label>
                    <input name="title" type="text" class="form-control" id="title" value="{{ old('title',$post->title) }}">
                </div>
                
                {{-- Image --}}
                <div class="form-group col-6 d-flex align-items-end justify-content-end">
                    <label for="image"></label>
                    <input name="image" type="file" id="image" value="{{ old('image',$post->image) }}">
                </div>

                {{-- Content --}}
                <div class="form-group col-6">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" rows="3" name="content">{{ old('content',$post->content) }}</textarea>
                </div>

                {{-- Post is mine? --}}
                @if(!Route::is('admin.posts.create'))
                    @if($post->user_id != Auth::id())
                        <div class="d-flex align-items-end justify-content-end col-6">
                            <div class="form-group form-check">
                                <label for="my_post" class="mr-4">Vuoi che il post sia tuo? Spunta qui</label>
                                <input name="my_post" type="checkbox" class="form-check-input" id="my_post" value="1">
                            </div>
                        </div>
                    @endif
                @endif

                {{-- Tags --}}
                <div class="form-group col-6">
                    <h5>Tag</h5>
                    @forelse ($tags as $tag)
                        <label for="tag-{{ $tag->label }}" class="mr-4">{{ $tag->label }}</label>
                        <input 
                            name="tags[]" 
                            type="checkbox" 
                            class="form-check-input" 
                            id="tag-{{ $tag->label }}" 
                            value="{{ $tag->id }}"
                            @if(in_array($tag->id,old('tags',$prev_tags ?? []))) checked @endif
                            >
                    @empty
                        <p>-</p>
                    @endforelse
                </div>

                {{-- Is Published --}}
                <div class="form-group col-6">
                    <label for="is_published" class="mr-4">Pubblicato</label>
                    <input 
                        name="is_published" 
                        type="checkbox" 
                        class="form-check-input" 
                        id="is_published" 
                        value="1"
                        @if($post->is_published) checked @endif
                        >
                </div>

                {{-- Categories --}}
                <div class="form-group col-6">
                    <select name="category_id" class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                        <option value="">Tutte le categorie</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if($category->id == $post->category_id) selected @endif>{{ $category->label }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Button --}}
                <div class="form-group col-6 d-flex align-items-end justify-content-end">
                    <button class="btn btn-success" type="submit">
                        Submit
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>

          </form>
    </div>
@endsection