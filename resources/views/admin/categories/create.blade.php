@extends('layouts.app')

@section('content')
    <div class="container">
        @if($category->exists)
            <h1 class="text-center mb-5">Edit: {{ $category->label }}</h1>
            <form action="{{ route('admin.categories.update',$category) }}" method="POST" class="d-flex flex-wrap">
                @method('PUT')
        @else
            <h1 class="text-center mb-5">Create new category</h1>
            <form action="{{ route('admin.categories.store',$category) }}" method="POST" class="d-flex flex-wrap">
        @endif
            @csrf
                {{-- Title --}}
                <div class="form-group col-6">
                    <label for="label">Label</label>
                    <input name="label" type="text" class="form-control" id="label" value="{{ old('label',$category->label) }}">
                </div>
                
                {{-- Color --}}
                <div class="form-group col-6">
                    <label for="color">Color</label>
                    <select class="form-control" id="color" name="color">
                        <option value="">Nessuna categoria scelta</option>
                        @foreach ($colors as $color)
                            <option value="{{ $color['value'] }}" @if(old('color',$category->color)=== $color['value']) selected @endif>{{ $color['name'] }}</option>
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