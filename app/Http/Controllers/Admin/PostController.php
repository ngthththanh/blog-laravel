<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    const PATH_VIEW = 'admin.posts.';
    const PATH_UPLOAD = 'posts';

    public function index()
    {
        $data = Post::with(['category', 'tags', 'user'])->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    public function create()
    {
        $categories = Category::where('is_active', 1)->pluck('name', 'id')->all();
        $tags = Tag::pluck('name', 'id')->all();
        $authorName = Auth::user()->name;

        return view(self::PATH_VIEW . __FUNCTION__, compact('categories', 'tags', 'authorName'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
            ],
            [
                'title.required' => 'Tiêu đề bài viết là bắt buộc',
            ]
        );
        $dataPost = $request->except('tags');
        $dataPost['is_active'] = $request->has('is_active') ? 1 : 0;
        $dataPost['is_popular'] = $request->has('is_popular') ? 1 : 0;
        $dataPost['is_show_home'] = $request->has('is_show_home') ? 1 : 0;
        $dataPost['is_trending'] = $request->has('is_trending') ? 1 : 0;
        $dataPost['slug'] = Str::slug($dataPost['title']) . '-' . $dataPost['sku'];
        $dataPost['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $dataPost['image'] = $request->file('image')->store('posts', 'public');
        }

        $post = Post::create($dataPost);

        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Thêm mới bài viết thành công');
    }

    public function show(string $id)
    {
        $post = Post::with(['category', 'tags', 'user'])->findOrFail($id);
        $categories = Category::pluck('name', 'id')->all();
        $tags = Tag::pluck('name', 'id')->all();

        return view(self::PATH_VIEW . __FUNCTION__, compact('post', 'categories', 'tags'));
    }

    public function edit(string $id)
    {
        $post = Post::with(['tags'])->findOrFail($id);
        $categories = Category::where('is_active', 1)->pluck('name', 'id')->all();
        $tags = Tag::pluck('name', 'id')->all();


        return view(self::PATH_VIEW . __FUNCTION__, compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'title' => 'required',
            ],
            [
                'title.required' => 'Tiêu đề bài viết là bắt buộc',
            ]
        );
        $post = Post::findOrFail($id);
        $dataPost = $request->except('tags');
        $dataPost['is_active'] = $request->has('is_active') ? 1 : 0;
        $dataPost['is_popular'] = $request->has('is_popular') ? 1 : 0;
        $dataPost['is_show_home'] = $request->has('is_show_home') ? 1 : 0;
        $dataPost['is_trending'] = $request->has('is_trending') ? 1 : 0;
        $dataPost['slug'] = Str::slug($dataPost['title']) . '-' . $dataPost['sku'];
        $dataPost['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $dataPost['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($dataPost);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Cập nhật bài viết thành công');
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->tags()->detach();
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Xóa bài viết thành công');
    }
}