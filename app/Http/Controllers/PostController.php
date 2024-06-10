<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function updatePost(Post $post, Request $request){
        if ($post->user_id !== auth()->id()) {
            return redirect('/')->with('error', 'You are not authorized to update this post.');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);

        $post->update($incomingFields);
        return redirect('/');
    }
    public function editPost(Post $post){
        if ($post->user_id !== auth()->id()) {
            return redirect('/')->with('error', 'You are not authorized to edit this post.');
        }

        return view('edit-post', compact('post'));
    }
    public function createPost(Request $request){
        $incomingFields = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);
        $incomingFields['user_id'] = auth()->id();

        Post::create($incomingFields);
        return redirect('/');
    }

    public function deletePost(Post $post){
        if ($post->user_id !== auth()->id()) {
            return redirect('/')->with('error', 'You are not authorized to delete this post.');
        }

        $post->delete();
        return redirect('/');
    }
}
