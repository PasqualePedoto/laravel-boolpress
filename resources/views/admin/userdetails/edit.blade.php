@extends('layouts.app')

@section('content')
    <form action="{{ route('admin.userdetails.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="container">
            <div class="row">
                {{-- First Name --}}
                <div class="form-group col-6">
                    <label for="first_name">Nome</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name',$details->first_name) }}">
                </div>
                {{-- Last Name --}}
                <div class="form-group col-6">
                    <label for="last_name">Cognome</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name',$details->last_name) }}">
                </div>
                {{-- Year of Birth --}}
                <div class="form-group col-6">
                    <label for="year_of_birth">Anno di nascita</label>
                    <input type="number" min="1900" max="2022" step="1" class="form-control" id="year_of_birth" name="year_of_birth" value="{{ old('year_of_birth',$details->year_of_birth) }}">
                </div>
                {{-- Address --}}
                <div class="form-group col-6">
                    <label for="address">Indirizzo</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address',$details->address) }}">
                </div>
                {{-- Button --}}
                <div class="form-group col-6">
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk mr-2"></i>Salva</button>
                </div>
            </div>
        </div>
    </form>
@endsection