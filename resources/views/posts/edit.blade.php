@extends('layouts.app')

@section('title', 'edit post')

@section('content')
    <div class="container my-3">
        <div class="row ">
            <div class="col-1"></div>
            <div class="col-8">
                <h4 style="display: inline">Edit post:</h4>
                <a href="{{ route('posts.index') }}" class="btn btn-primary float-end">go back</a>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-8">
                <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Post title</label>
                        <input type="text" class="form-control" name="title" value="{{ $post->title }}"
                            id="title">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Post description</label>
                        <textarea class="form-control" name="description" id="description" rows="3">{{ $post->description }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="file" class="form-control" name="cover" id="cover">
                        <label class="input-group-text" for="cover">Update main photo</label>
                    </div>

                    <div class="input-group mb-3">
                        <input type="file" class="form-control" name="images[]" multiple id="img">
                        <label class="input-group-text" for="img">Add additional photos</label>
                    </div>

                    <div class="mb-3">
                        <div class="d-grid gap-2 col-3 mx-auto">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-3">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="mb-3">
                            <p class="">Main photo:</p>
                            <div class="card">
                                <img src="{{ asset('/images/posts/cover/' . $post->cover) }}" class="card-img">
                            </div>
                        </div>
                        <div class="mb-3">
                            <p class="">Additional photos:</p>
                            @foreach ($post->images as $image)
                                <div class="card mb-2">
                                    <img src=" {{ asset('/images/posts/images/' . $image->image) }}" class="card-img">
                                    <form action="/deleteimage/{{ $image->id }}" method="post">
                                        <button class="btn text-danger">Remove</button>
                                        @csrf
                                        @method('delete')
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
