<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Lấy dữ liệu từ bảng posts
        $data = DB::table('posts')->get();
        dd($data);
        // Truyền dữ liệu ra view
        return view('home', ['posts' => $data]);
    }
}