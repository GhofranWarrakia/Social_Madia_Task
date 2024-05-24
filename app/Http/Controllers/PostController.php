<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            $posts=Post::with('category')->get();
            return $this->customApi(PostResource::collection($posts),'all post',205);
            }
    }  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

        $post = new Post($request->all());
        $post->user_id = Auth::id();
        $post->save();

        return $post;
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return response()->json($posts);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if ($post->user_id != Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

        $post->update($request->all());
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->user_id != Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $post->delete();
        return response()->json(['message' => 'Post deleted']);
    }
}