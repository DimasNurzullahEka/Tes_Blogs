<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PostModel;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = PostModel::all();
        return view('admin.Post', compact('posts'));
    }
    public function create()
    {
        return view('admin.Post.tambahPost');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'date' => 'required',
            'username' => 'required',
        ]);

        PostModel::create($validatedData);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }
    public function destroy(PostModel $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
