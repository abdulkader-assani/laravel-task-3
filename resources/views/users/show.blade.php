@extends('layouts.app')

@section('title', 'show user')

@section('content')
    <div class="container my-3">
        <div class="row ">
            <div class="col-2"></div>
            <div class="col-8">
                <h4>Show user detail:
                    <a href="{{ route('users.index') }}" class="btn btn-success float-end">go back</a>
                </h4>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10 card my-2">
                <table class="table table-striped table-hover mt-3">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Admin</th>
                            <th scope="col">Created_at</th>
                            <th scope="col">Updated_at</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->is_admin }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                            </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
@endsection
