<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Lấy dữ liệu từ bảng tags, categories và posts
        $tags = $this->getTags();
        $categories = $this->getActiveCategories();
        $posts = $this->getAllPosts();
        $postNew = $this->getLatestPost();
        $postTrending = $this->getTrendingPosts();
        $postPopular = $this->getPopularPost();

        // Truyền dữ liệu ra view
        return view('client/index', [
            'posts' => $posts,
            'post_trending' => $postTrending,
            'post_popular' => $postPopular,
            'post_new' => $postNew,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function post_detail(string $id)
    {
        $tags = $this->getTags();
        $categories = $this->getActiveCategories();
        $post = Post::with('tags')->findOrFail($id);

        return view('client/post_detail', [
            'post' => $post,
            'tags' => $tags,
            'categories' => $categories,
        ]);
    }

    public function post_all()
    {
        $tags = $this->getTags();
        $categories = $this->getActiveCategories();
        $posts = $this->getAllPosts();

        return view('client/post_all', [
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function search_category($id)
    {
        $tags = $this->getTags();
        $categories = $this->getActiveCategories();
        $category = Category::findOrFail($id);
        $searchCategories = $category->posts()->with('tags', 'user')->get();

        return view('client/search_category', [
            'tags' => $tags,
            'categories' => $categories,
            'category' => $category,
            'search_categories' => $searchCategories,
        ]);
    }

    /**
     * Get all tags.
     *
     * @return \Illuminate\Support\Collection
     */
    private function getTags()
    {
        return DB::table('tags')->pluck('name');
    }

    /**
     * Get active categories.
     *
     * @return \Illuminate\Support\Collection
     */
    private function getActiveCategories()
    {
        return Category::where('is_active', 1)->get();
    }

    /**
     * Get all posts with tags and user.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getAllPosts()
    {
        return Post::with('tags', 'user')->orderBy('id', 'desc')->get();
    }

    /**
     * Get the latest post.
     *
     * @return \App\Models\Post|null
     */
    private function getLatestPost()
    {
        return Post::with('tags', 'user')->orderBy('created_at', 'desc')->first();
    }

    /**
     * Get trending posts (latest 3).
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getTrendingPosts()
    {
        return Post::with('tags')
            ->where('is_trending', 1)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
    }

    /**
     * Get the most popular post.
     *
     * @return \App\Models\Post|null
     */
    private function getPopularPost()
    {
        return Post::with('tags', 'user')
            ->where('is_popular', 1)
            ->orderBy('created_at', 'desc')
            ->first();
    }
}