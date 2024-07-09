<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        //Lấy dữ liệu từ bảng tags
        $tags = DB::table('tags')->pluck('name')->all();

        //Lấy dữ liệu từ bảng categories
        $categories = DB::table('categories')->pluck('name')->all();

           // Lấy bài viết theo ID
        $post = Post::with('tags')->find($id);

        // Kiểm tra xem bài viết có tồn tại không
        if (!$post) {
            abort(404);
        }

        // Truyền dữ liệu ra view

        return view(
            'client/post_detail',['post'=> $post,'tags' => $tags, 'categories' => $categories]
        );
    }

}