<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Lấy dữ liệu từ bảng tags
        $tags = DB::table('tags')->pluck('name')->all();

        //Lấy dữ liệu từ bảng categories
        $categories = DB::table('categories')->where('is_active', '1')->pluck('name')->all();

        // Lấy dữ liệu từ bảng posts
        $posts = Post::with('tags')->get();

        // Lấy dữ liệu bài viết mới nhất từ bảng posts
        $post_new = Post::with('tags')->orderBy('created_at', 'desc')->first();

        // Lấy các bài viết đang trending (3 bài mới nhất)
        $post_trending = Post::with('tags')
            ->where('is_trending', 1)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Lấy bài viết phổ biến (1 bài mới nhất)
        $post_popular = Post::with('tags')
            ->where('is_popular', 1)
            ->orderBy('created_at', 'desc')
            ->first();

        // Truyền dữ liệu ra view
        return view(
            'client/home',
            [
                'posts' => $posts,
                'post_trending' => $post_trending,
                'post_popular' => $post_popular,
                'post_new' => $post_new,
                'categories' => $categories,
                'tags' => $tags
            ]
        );
    }
}