<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view("posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'cover' => 'required|image',
            'image' => 'image',
        ]);

        if ($file = $request->file('cover')) {
            $cover_name = $file->getClientOriginalName() . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/images/posts/cover'), $cover_name);
        }
        
        $post = new Post([
            'title' => $request->title,
            'description' => $request->description,
            'cover' => $cover_name,
        ]);
        $post->save();

        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $image_name = $file->getClientOriginalName() . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/images/posts/images'), $image_name);
                Image::create([
                    'image' => $image_name,
                    'post_id' => $post->id
                ]);
            }
        }

        return redirect()->route('posts.index')->with('status', 'Post Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view("posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post, Image $image)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'cover' => 'image',
            'image' => 'image',
        ]);

        if ($file = $request->file('cover')) {
            $cover_name = $file->getClientOriginalName() . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/images/posts/cover'), $cover_name);
        } else {
            $cover_name = $post->cover;
        }

        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $image_name = $file->getClientOriginalName() . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/images/posts/images'), $image_name);
                Image::create([
                    'image' => $image_name,
                    'post_id' => $post->id
                ]);
            }
        }

        $post->update([
            "title" => $request->title,
            "description" => $request->description,
            'cover' => $cover_name,
        ]);

        return redirect()->route('posts.index')->with('status', 'Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Post $post)
    {
        if ($request->user()->cannot('delete', $post)) {
            abort(403);
        }
        
        $post->findOrFail($post->id);
        if (File::exists("images/posts/cover/" . $post->cover)) {
            File::delete("images/posts/cover/" . $post->cover);
        }
        $images = Image::where("post_id", $post->id)->get();
        foreach ($images as $image) {
            if (File::exists("images/posts/images/" . $image->image)) {
                File::delete("images/posts/images/" . $image->image);
            }
        }
        $post->delete();
        return redirect('/posts')->with('status', 'Post Deleted Successfully');
    }
    
    public function deleteimage($id)
    {
        $images = Image::findOrFail($id);
        if (File::exists("images/posts/images/" . $images->image)) {
            File::delete("images/posts/images/" . $images->image);
        }
    
        Image::find($id)->delete();
        return back();
    }
}
