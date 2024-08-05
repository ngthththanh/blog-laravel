<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Hiển thị trang.
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

        // Lấy tổng số bài viết
        $totalPosts = Post::count();
        $totalPages = ceil($totalPosts / $perPage);

        // Lấy các bài viết, bao gồm các thẻ và người dùng liên quan
        $posts = Post::with('tags', 'user')
            ->orderBy('id', 'desc')
            ->skip(($currentPage - 1) * $perPage)
            ->take($perPage)
            ->get();

        // Trả về view
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

    // Chi tiết bài viết dựa trên slug
    public function post_detail(string $slug)
    {
        // Lấy dữ liệu từ bảng tags, categories và posts.

        $tags = $this->getTags();
        $categories = $this->getActiveCategories();
        // Tìm kiếm bài post theo slug(id)
        $post = Post::with('tags')->where('slug', $slug)->firstOrFail();

        return view('client/post_detail', [
            'post' => $post,
            'tags' => $tags,
            'categories' => $categories,
        ]);
    }

    // Thêm bình luận vào bài viết
    public function addcomment(Request $request, Post $post)
    {
        // Validate
        $request->validate([
            'content' => 'required'
        ]);
        // Thêm bình luận
        Comment::create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        // Trả về view
        return redirect()->back()->with('success', 'Bình luận đã được thêm.');
    }

    // Lấy tất cả các bài viết
    public function post_all(Request $request)
    {
        $perPage = 3; // Số bài viết trên mỗi trang
        $currentPage = $request->input('page', 1); // Lấy số trang hiện tại từ query string, mặc định là trang 1

        // Lấy dữ liệu từ bảng tags, categories và posts
        $tags = $this->getTags();
        $categories = $this->getActiveCategories();

        // Lấy tổng số bài viết
        $totalPosts = Post::count();
        $totalPages = ceil($totalPosts / $perPage);

        // Lấy các bài viết, bao gồm các thẻ và người dùng liên quan
        $posts = Post::with('tags', 'user')
            ->orderBy('id', 'desc')
            ->skip(($currentPage - 1) * $perPage)
            ->take($perPage)
            ->get();

        // Trả về view
        return view('client/post_all', [
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
            'totalPages' => $totalPages,
            'currentPage' => $currentPage,
        ]);
    }


    // Hiển thị trang liên hệ
    public function contact()
    {

        $tags = $this->getTags();
        $categories = $this->getActiveCategories();
        $posts = $this->getAllPosts();

        return view('client/contact', [
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    // Tìm kiếm bài viết
    public function search(Request $request)
    {
        $perPage = 3; // Số bài viết trên mỗi trang
        $currentPage = $request->input('page', 1); // Lấy số trang hiện tại từ query string, mặc định là trang 1

        // Lấy dữ liệu từ bảng tags, categories và posts
        $tags = $this->getTags();
        $categories = $this->getActiveCategories();

        // Lấy tổng số bài viết
        $totalPosts = Post::count();
        $totalPages = ceil($totalPosts / $perPage);

        // Lấy từ khóa tìm kiếm từ request
        $search = $request->search;

        // Tìm kiếm các bài viết dựa trên từ khóa
        $posts = Post::where(function ($query) use ($search) {
            $query->where('title', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
        })
            ->orWhereHas('category', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orWhereHas('tags', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orWhereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->get();

        // Trả về view
        return view('client.post_all', compact(
            'posts',
            'search',
            'tags',
            'categories',
            'totalPages',
            'currentPage'
        ));
    }


    // Tìm kiếm bài viết theo danh mục
    public function search_category(Request $request, $slug)
    {
        $perPage = 3; // Số bài viết trên mỗi trang
        $currentPage = $request->input('page', 1); // Lấy số trang hiện tại từ query string, mặc định là trang 1

        // Lấy dữ liệu từ bảng tags, categories và posts
        $tags = $this->getTags();
        $categories = $this->getActiveCategories();

        // Lấy tổng số bài viết
        $totalPosts = Post::count();
        $totalPages = ceil($totalPosts / $perPage);
        // Lấy tất cả các tag và danh mục
        $tags = $this->getTags();
        $categories = $this->getActiveCategories();
        $category = Category::where('slug', $slug)->firstOrFail();
        $searchCategories = $category->posts()->with('tags', 'user')->get();

        // Trả về view
        return view('client/search_category', [
            'tags' => $tags,
            'categories' => $categories,
            'category' => $category,
            'search_categories' => $searchCategories,
            'totalPages' => $totalPages,
            'currentPage' => $currentPage,
        ]);
    }

    // Tìm kiếm bài viết theo thẻ
    public function search_tag(Request $request, string $name)
    {
        $perPage = 3; // Số bài viết trên mỗi trang
        $currentPage = $request->input('page', 1); // Lấy số trang hiện tại từ query string, mặc định là trang 1

        // Lấy dữ liệu từ bảng tags, categories và posts
        $tags = $this->getTags();
        $categories = $this->getActiveCategories();

        // Lấy tổng số bài viết
        $totalPosts = Post::count();
        $totalPages = ceil($totalPosts / $perPage);
        // Lấy tất cả các tag và danh mục

        $tags = $this->getTags();
        $categories = $this->getActiveCategories();
        $tag = Tag::where('name', $name)->firstOrFail();
        $searchTag = $tag->posts()->with('category', 'user')->get();

        // Trả về view
        return view('client/search_tag', [
            'tags' => $tags,
            'categories' => $categories,
            'tag' => $tag,
            'search_tags' => $searchTag,
            'totalPages' => $totalPages,
            'currentPage' => $currentPage,
        ]);
    }

    // Lấy tất cả các thẻ
    private function getTags()
    {
        return Tag::all();
    }

    // Lấy các danh mục đang hoạt động
    private function getActiveCategories()
    {
        return Category::where('is_active', 1)->withCount('posts')->get();
    }

    // Lấy tất cả các bài viết
    private function getAllPosts()
    {
        return Post::with('tags', 'user')->orderBy('id', 'desc')->get();
    }

    // Lấy bài viết mới nhất
    private function getLatestPost()
    {
        return Post::with('tags', 'user')->orderBy('created_at', 'desc')->first();
    }

    // Lấy các bài viết thịnh hành (mới nhất 3 bài)
    private function getTrendingPosts()
    {
        return Post::with('tags')
            ->where('is_trending', 1)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
    }

    // Lấy bài viết phổ biến nhất
    private function getPopularPost()
    {
        return Post::with('tags', 'user')
            ->where('is_popular', 1)
            ->orderBy('created_at', 'desc')
            ->first();
    }
}