@extends('layouts.login_layout')

@section('title', 'login')

@section('content')
    <div class="container my-3">
        <div class="row ">
            <div class="col-2"></div>
            <div class="col-8">
                <h3>Log in:</h3>
                <form action="{{ route('login') }}" method="POST" class="mt-5">
                    @method('post')
                    @csrf
                    @session('status')
                    <div class="alert alert-danger">
                        {{ session('status') }}
                    </div>
                @endsession
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" type="email" placeholder="abd@gmail.com" name="email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input class="form-control" type="password" placeholder="********" name="password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="d-grid gap-2 col-3 mx-auto">
                            <button type="submit" class="btn btn-success">login</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
@endsection
