<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.posts.';
    const PATH_UPLOAD = 'posts';

    public function index()
    {
        $data = Post::with(['category', 'tags'])->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('is_active', 1)->pluck('name', 'id')->all();
        $tags = Tag::pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataPost = $request->except('tags');
        $dataPost['is_active'] = $request->has('is_active') ? 1 : 0;
        $dataPost['is_popular'] = $request->has('is_popular') ? 1 : 0;
        $dataPost['is_show_home'] = $request->has('is_show_home') ? 1 : 0;
        $dataPost['is_trending'] = $request->has('is_trending') ? 1 : 0;
        $dataPost['slug'] = Str::slug($dataPost['title']) . '-' . $dataPost['sku'];

        if ($request->hasFile('image')) {
            $dataPost['image'] = $request->file('image')->store('posts', 'public');
        }

        $post = Post::create($dataPost);

        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with(['category', 'tags'])->findOrFail($id);
        $categories = Category::pluck('name', 'id')->all();
        $tags = Tag::pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('post', 'categories', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::with(['tags'])->findOrFail($id);
        $categories = Category::where('is_active', 1)->pluck('name', 'id')->all();
        $tags = Tag::pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
        $dataPost = $request->except('tags');
        $dataPost['is_active'] = $request->has('is_active') ? 1 : 0;
        $dataPost['is_popular'] = $request->has('is_popular') ? 1 : 0;
        $dataPost['is_show_home'] = $request->has('is_show_home') ? 1 : 0;
        $dataPost['is_trending'] = $request->has('is_trending') ? 1 : 0;
        $dataPost['slug'] = Str::slug($dataPost['title']) . '-' . $dataPost['sku'];

        if ($request->hasFile('image')) {
            $dataPost['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($dataPost);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully.');
    }
}