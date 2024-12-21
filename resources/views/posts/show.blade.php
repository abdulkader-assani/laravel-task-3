@extends('layouts.app')

@section('title', 'show post')

@section('content')
    <div class="container my-3">
        <div class="row ">
            <div class="col-2"></div>
            <div class="col-8">
                <h4>Show post detail:
                    <a href="{{ route('posts.index') }}" class="btn btn-success float-end">go back</a>
                </h4>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 card my-2">

                <div class="card-header d-flex flex-wrap">
                    <div class="col-6">
                        <h3 class="card-title col-8">{{ $post->title }}</h3>
                        <p class="col-8">add at:{{ $post->created_at }}</p>
                    </div>
                    <div class="col-6">
                        @can('delete', $post)
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline float-end mx-1">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger my-2" type="submit"
                                    onclick="return confirm('Are you sure to delete this post ?');">Delete post</button>
                            </form>
                        @endcan
                        <a href="{{ route('posts.edit', $post->id) }}" class="text-decoration-none float-end">
                            <button type="button" class="btn btn-primary my-2 ">Edit post</button>
                        </a>
                    </div>
                </div>

                <div class="card-body ">

                    <p class="card-text">{{ $post->description }}</p>

                    <div class="container">
                        <div class="row">
                            <div>
                                <img src=" {{ asset('/images/posts/cover/' . $post->cover) }}" class="card-img">
                            </div>
                            @foreach ($post->images as $image)
                                <div class="col-4 mt-3">
                                    <img src=" {{ asset('/images/posts/images/' . $image->image) }}" class="card-img">
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
@endsection
