@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card" >
            <div class="row no-gutters">
              <div class="col-12 d-flex">
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">{{ $category->label }}</h5>
                    <p class="card-text">{{ $category->color }}</p>
                    <p class="card-text">
                      <small class="text-muted">
                        <div>{{ $category->created_at }}</div>
                        <div>{{ $category->updated_at }}</div>
                      </small>
                    </p>
                  </div>
                </div>  
              </div>
            </div>
        </div>
        {{-- Buttons --}}
        <div class="d-flex justify-content-between my-3">
          <div class="d-flex justify-content-end">
            {{-- View category --}}
            <div class="mr-3">
              <a href="{{ route('admin.categories.show',$category) }}" class="btn btn-success btn-small">
                <i class="fa-solid fa-eye"></i>
                <strong>View category</strong>
              </a>
            </div>

            {{-- Update category --}}
            <div class="mr-3">
              <a href="{{ route('admin.categories.edit',$category) }}" class="btn btn-warning btn-small">
                <i class="fa-solid fa-pencil"></i>
                <strong>Update category</strong>
              </a>
            </div>

            {{-- Delete category --}}
            <div class="mr-3">
              <form action="{{ route('admin.categories.destroy',$category) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">
                  <i class="fa-solid fa-trash"></i>
                  <strong>Delete category</strong>
                </button>
            </form>
            </div>
          </div>

          {{-- Return to lists --}}
          <div>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-small">
              <i class="fa-solid fa-rotate-left"></i>
              <strong>Return to list</strong>
            </a>
          </div>
        </div>
        <hr>
    </div>
@endsection