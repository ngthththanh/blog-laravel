<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.categories.';
    const PATH_UPLOAD = 'categories';
    public function index()
    {
        $data = Category::query()->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except(('cover'));
        $data['is_active'] ??= 0;
        if($request->hasFile('cover')){
            $data['cover'] = Storage::put(self::PATH_UPLOAD, $request->file('cover'));
        }
        Category::query()->create($data);
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = Category::query()->findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Category::query()->findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model = Category::findOrFail($id);

        // Lấy toàn bộ dữ liệu từ request, ngoại trừ trường 'cover'
        $data = $request->except('cover');

        // Bổ sung mặc định cho trường 'is_active' nếu không có giá trị từ request
        $data['is_active'] ??= 0;

        // Kiểm tra xem có file 'cover' được gửi lên trong request hay không
        if ($request->hasFile('cover')) {
            // Lưu trữ đường dẫn ảnh hiện tại của danh mục sản phẩm
            $currentCover = $model->cover;

            // Lưu file 'cover' mới vào storage và cập nhật đường dẫn vào database
            $data['cover'] = $request->file('cover')->store('public/covers');

            // Xóa file ảnh cũ nếu tồn tại và không phải là file mặc định
            if ($currentCover && $currentCover !== 'default.jpg' && Storage::exists($currentCover)) {
                Storage::delete($currentCover);
            }
        }

        // Cập nhật thông tin của danh mục sản phẩm vào database
        $model->update($data);

        // Chuyển hướng quay lại trang danh sách danh mục sản phẩm
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // Kiểm tra và xóa cover từ storage nếu tồn tại
        if ($category->cover && Storage::exists($category->cover)) {
            Storage::delete($category->cover);
        }

        // Xóa đối tượng category
        $category->delete();

        return back()->with('success', 'Xóa danh mục và cover thành công.');
    }
}