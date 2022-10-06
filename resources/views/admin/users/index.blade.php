@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Table --}}
    <table class="table table-striped">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Address</th>
            <th scope="col">Email</th>
            <th scope="col">Username</th>
            <th scope="col">Age</th>
            <th scope="col">N.posts</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->userDetail->first_name }}</td>
                    <td>{{ $user->userDetail->first_name }}</td>
                    <td>{{ $user->userDetail->address }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ date('Y') - $user->userDetail->year_of_birth }}</td>
                    <td>{{ count($user->posts)}}</td>
                    <td class="d-flex align-items-center justify-content-center">
                        {{-- View user --}}
                        <div class="mr-3">
                            <a href="{{ route('admin.users.show',$user) }}" class="btn btn-success btn-small">
                                <i class="fa-solid fa-eye"></i>
                                {{-- <strong>View post</strong> --}}
                            </a>
                        </div>
                        {{-- Update user --}}
                        <div class="mr-3">
                            <a href="{{ route('admin.users.edit',$user) }}" class="btn btn-warning btn-small">
                                <i class="fa-solid fa-pencil"></i>
                                {{-- <strong>Update post</strong> --}}
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
            <tr>
                <th colspan="7" class="text-center">Non ci sono utenti</th>
            </tr>
            @endempty
        </tbody>
    </table>

    <nav class="mt-5 d-flex align-items-center justify-content-center">
        @if($users->hasPages())
        {{ $users->links() }}
        @endif
    </nav>
    </div>
@endsection