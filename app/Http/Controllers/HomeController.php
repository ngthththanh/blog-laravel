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
    public function index(Request $request)
    {
        $perPage = 2; // Số bài viết trên mỗi trang
        $currentPage = $request->input('page', 1); // Lấy số trang hiện tại từ query string, mặc định là trang 1

        // Lấy dữ liệu từ bảng tags, categories và posts
        $tags = $this->getTags();
        $categories = $this->getActiveCategories();
        $postNew = $this->getLatestPost();
        $postTrending = $this->getTrendingPosts();
        $postPopular = $this->getPopularPost();

        // Lấy tất cả các bài viết
        $totalPosts = Post::count();
        $totalPages = ceil($totalPosts / $perPage);

        $posts = Post::with('tags', 'user')
            ->orderBy('id', 'desc')
            ->skip(($currentPage - 1) * $perPage)
            ->take($perPage)
            ->get();


        // Truyền dữ liệu ra view
        return view('client/index', [
            'posts' => $posts,
            'post_trending' => $postTrending,
            'post_popular' => $postPopular,
            'post_new' => $postNew,
            'categories' => $categories,
            'tags' => $tags,
            'totalPages' => $totalPages,
            'currentPage' => $currentPage,
        ]);
    }


    public function post_detail(string $slug)
    {
        $tags = $this->getTags();
        $categories = $this->getActiveCategories();
        $post = Post::with('tags')->where('slug', $slug)->firstOrFail();

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
    public function search_post(Request $request)
    {
        $searchTerm = $request->input('search_post');

        // Perform search logic here
        $searchPosts = Post::where('title', 'LIKE', '%' . $searchTerm . '%')
                     ->orWhere('content', 'LIKE', '%' . $searchTerm . '%')
                     ->get();

        $tags = $this->getTags();
        $categories = $this->getActiveCategories();

        return view('client.search_post', [
            'search_posts' => $searchPosts,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }
    // app/Http/Controllers/HomeController.php

    public function search_category($slug)
    {
        $tags = $this->getTags();
        $categories = $this->getActiveCategories();
        $category = Category::where('slug', $slug)->firstOrFail();
        $searchCategories = $category->posts()->with('tags', 'user')->get();

        return view('client/search_category', [
            'tags' => $tags,
            'categories' => $categories,
            'category' => $category,
            'search_categories' => $searchCategories,
        ]);
    }
    public function search_tag($slug)
    {
        $tags = $this->getTags();
        $categories = $this->getActiveCategories();
        $category = Category::where('slug', $slug)->firstOrFail();
        $searchTag = $category->posts()->with('tags', 'user')->get();

        return view('client/search_category', [
            'tags' => $tags,
            'categories' => $categories,
            'category' => $category,
            'search_tags' => $searchTag,
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
        return Category::where('is_active', 1)->withCount('posts')->get();
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