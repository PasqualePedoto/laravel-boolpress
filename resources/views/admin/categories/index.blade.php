@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Title --}}
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1>Lista delle categorie</h1>
        <div>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-success">
                <i class="fa-solid fa-square-plus mr-2"></i>
                <strong>Add new category</strong>
            </a>
        </div>
    </div>

    {{-- Table --}}
    <table class="table table-striped">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">label</th>
            <th scope="col">color</th>
            <th scope="col">posts number</th>
            <th scope="col">created_at</th>
            <th scope="col">updated_at</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->label }}</td>
                    <td>{{ $category->color }}</td>
                    <td>{{ count($category->posts) }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td class="d-flex align-items-center justify-content-center">
                        {{-- View category --}}
                        <div class="mr-3">
                            <a href="{{ route('admin.categories.show',$category) }}" class="btn btn-success btn-small">
                                <i class="fa-solid fa-eye"></i>
                                {{-- <strong>View category</strong> --}}
                            </a>
                        </div>

                        {{-- Update category --}}
                        <div class="mr-3">
                            <a href="{{ route('admin.categories.edit',$category) }}" class="btn btn-warning btn-small">
                                <i class="fa-solid fa-pencil"></i>
                                {{-- <strong>Update category</strong> --}}
                            </a>
                        </div>

                        {{-- Delete category --}}
                        <div class="mr-3">
                            <form action="{{ route('admin.categories.destroy',$category) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
            <tr>
                <th scope="row">Non ci sono categorie</th>
            </tr>
            @endempty
        </tbody>
    </table>

    <nav class="mt-5 d-flex align-items-center justify-content-center">
        @if($categories->hasPages())
        {{ $categories->links() }}
        @endif
    </nav>
@endsection