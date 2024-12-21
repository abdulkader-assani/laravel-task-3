@extends('layouts.app')

@section('title', 'add user')

@section('content')
    <div class="container my-3">
        <div class="row ">
            <div class="col-2"></div>
            <div class="col-8">
                <h4 style="display: inline">Create new user:</h4>
                <a href="{{ route('users.index') }}" class="btn btn-primary float-end">go back</a>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-2"> </div>
            <div class="col-8">
                <form action="{{ route('users.store') }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">User name:</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="abd">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="abd@gmail.com">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="********">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Are you an admin:</label>
                        <div class="form-check">
                            <input checked class="form-check-input" type="radio" name="is_admin" value="0" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                No
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_admin" id="flexRadioDefault2" value="1">
                            <label class="form-check-label" for="flexRadioDefault2">
                                yes
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-grid gap-2 col-3 mx-auto">
                            <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
@endsection
