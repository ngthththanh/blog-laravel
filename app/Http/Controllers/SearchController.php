<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        // Lấy dữ liệu từ bảng tags
        $tags = DB::table('tags')->pluck('name')->all();

        // Lấy dữ liệu từ bảng categories
        $categories = DB::table('categories')->where('is_active', '1')->get();

        // Lấy bài viết theo ID
        $post = Post::with('tags')->find($id);

        // Kiểm tra xem bài viết có tồn tại không
        // if (!$post) {
        //     abort(404);
        // }
        // Lấy các bài viết thuộc cùng danh mục
        $category = Category::findOrFail($id);
        $search_category = $category->posts()->with('tags', 'user')->get();
        // Truyền dữ liệu ra view
        return view('client.search_category', [
            'post' => $post,
            'tags' => $tags,
            'categories' => $categories,
            'category' => $category,
            'search_categories' => $search_category
        ]);
    }
}