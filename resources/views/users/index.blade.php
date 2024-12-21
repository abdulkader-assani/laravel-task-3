@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container my-3">
    <div class="row ">
        <div class="col-1"></div>
        <div class="col-10">
            @session('status')
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endsession
            <h2 class="d-inline">Users list:</h2>
            <div class="d-inline float-end">
                <a href="{{ route('users.create') }}" class="btn btn-success">Add new user</a>
            </div>
            <table class="table table-striped table-hover mt-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Admin</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->is_admin }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="text-decoration-none">
                                    <button type="button" class="btn btn-primary my-2">Edit user</button>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger my-2" type="submit"
                                        onclick="return confirm('Are you sure to delete this post ?');">Delete
                                        user</button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('users.show', $user->id) }}" class="text-decoration-none">
                                    <button type="button" class="btn btn-success my-2">Show details</button>
                                </a>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-1"></div>
    </div>
</div>
@endsection
