<?php

namespace App\Http\Controllers;

use App\Models\Commenting;
use Illuminate\Http\Request;

class CommentingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commenting= Commenting::all();
return  $commenting;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json($commenting);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $postId)
    {
        $request->validate(['body' => 'required']);
        $comment = new Commenting($request->all());
        $comment->user_id = Auth::id();
        $comment->post_id = $postId;
        $comment->save();

        return $comment;
    }
    /**
     * Display the specified resource.
     */
    public function show(Commenting $commenting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commenting $commenting)
    {
        return response()->json($commenting);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commenting $commenting)
    {
        if ($comment->user_id != Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate(['body' => 'required']);
        $comment->update($request->all());
        return $comment;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commenting $commenting)
    {
        if ($comment->user_id != Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $comment->delete();
        return response()->json(['message' => 'Comment deleted']);
    }
}

