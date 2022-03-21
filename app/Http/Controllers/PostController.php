<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class PostController extends Controller
{
    public function index(Post $post)
    {
        $posts = $post->getList();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request, Post $post)
    {
        $data = $request->only('title', 'content');
        $create = $post->createPost($data);
        return redirect()->route('list.post')->with(['alert-type' => 'success', 'message' => 'Create post successfully']);
    }
    public function edit(Post $post, $id)
    {
        $data = $post->getPostById($id);
        return view('posts.edit', compact('data'));
    }

    public function update(StorePostRequest $request, Post $post)
    {
        $data = $request->only('id', 'title', 'content');
        $create = $post->updatePost($data);
        return redirect()->route('list.post')->with(['alert-type' => 'success', 'message' => 'Update post successfully']);
    }

    public function destroy(Request $request, Post $post)
    {
        if($request->ajax()){
            $delete = $post->deletePost($request->id);
            return response()->json([
                    'message' => 'Delete success'
            ]);
        }
        
    }
}
