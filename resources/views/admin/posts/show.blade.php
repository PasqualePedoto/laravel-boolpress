@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card" >
            <div class="row no-gutters">
              <div class="col-12 d-flex">
                <img src="{{ asset('storage/'.$post->image) }}" alt="post-image" class="img-fluid w-50">
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->content }}</p>
                    <div>
                      <h5>Tags</h5>
                      @forelse($post->tags as $tag)
                        <span class="badge badge-pill" style="background-color: {{ $tag->color }}">{{ $tag->label }}</span>
                      @empty
                        -
                      @endforelse
                    </div>
                    <p class="card-text">
                      <small class="text-muted">
                        <div>{{ $post->created_at }}</div>
                        <div>{{ $post->updated_at }}</div>
                      </small>
                      <div>Autore: {{ $post->author->name }}</div>
                    </p>
                  </div>
                </div>  
              </div>
            </div>
        </div>
        {{-- Buttons --}}
        <div class="d-flex justify-content-between my-3">
          <div class="d-flex justify-content-end">
            {{-- View post --}}
            <div class="mr-3">
              <a href="{{ route('admin.posts.show',$post) }}" class="btn btn-success btn-small">
                <i class="fa-solid fa-eye"></i>
                <strong>View post</strong>
              </a>
            </div>

            {{-- Update post --}}
            <div class="mr-3">
              <a href="{{ route('admin.posts.edit',$post) }}" class="btn btn-warning btn-small">
                <i class="fa-solid fa-pencil"></i>
                <strong>Update post</strong>
              </a>
            </div>

            {{-- Delete post --}}
            <div class="mr-3">
              <form action="{{ route('admin.posts.destroy',$post) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">
                  <i class="fa-solid fa-trash"></i>
                  <strong>Delete post</strong>
                </button>
            </form>
            </div>
          </div>

          {{-- Return to lists --}}
          <div>
            <a href="{{ route('admin.posts.index',$post) }}" class="btn btn-secondary btn-small">
              <i class="fa-solid fa-rotate-left"></i>
              <strong>Return to list</strong>
            </a>
          </div>
        </div>
        <hr>
    </div>
@endsection