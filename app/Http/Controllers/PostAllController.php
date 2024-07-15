<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostAllController extends Controller
{
    /**
     * Display a listing of the resource.
     */

        public function index()
        {
            // Lấy dữ liệu từ bảng tags và users (bạn có thể sử dụng Eloquent cũng được cho đồng bộ hóa dữ liệu)
            $tags = DB::table('tags')->pluck('name')->all();
            $users = DB::table('users')->pluck('name')->all();

            // Lấy dữ liệu từ bảng categories
            $categories = Category::where('is_active', '1')->get();

            // Lấy dữ liệu từ bảng posts với quan hệ với tags
            $posts = Post::with('tags', 'user')->orderBy('id','desc')->get();
        
            // Truyền dữ liệu ra view
            return view('client.post_all', [
                'posts' => $posts,
                'categories' => $categories,
                'tags' => $tags,
                'users' => $users,
            ]);
        }
    }