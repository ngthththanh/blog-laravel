<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    const PATH_VIEW = 'admin.categories.';
    const PATH_UPLOAD = 'categories';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::latest('id')->get();
        return view(self::PATH_VIEW . 'index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . 'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
        ], [
            'name.required' => 'Tên danh mục là bắt buộc',
            'name.unique' => 'Tên danh mục đã được sử dụng',
        ]);

        $data = $request->except('cover');
        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = $request->has('is_active') ? $request->input('is_active') : 0;

        if ($request->hasFile('cover')) {
            $data['cover'] = Storage::put(self::PATH_UPLOAD, $request->file('cover'));
        }

        Category::create($data);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = Category::findOrFail($id);
        return view(self::PATH_VIEW . 'show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Category::findOrFail($id);
        return view(self::PATH_VIEW . 'edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Find the category or fail
    $model = Category::findOrFail($id);

    // Validate the request data
    $request->validate([
        'name' => 'required|unique:categories,name,' . $id,
    ], [
        'name.required' => 'Tên danh mục là bắt buộc',
        'name.unique' => 'Tên danh mục đã được sử dụng',
    ]);

    // Prepare the data for updating
    $data = $request->except('cover');
    $data['slug'] = Str::slug($data['name']);
    $data['is_active'] = $request->has('is_active') ? $request->input('is_active') : 0;

    // Handle the cover file upload
    if ($request->hasFile('cover')) {
        $currentCover = $model->cover;
        $data['cover'] = Storage::put(self::PATH_UPLOAD, $request->file('cover'));

        // Delete the old cover file if it exists and is not the default image
        if ($currentCover && $currentCover !== 'default.jpg' && Storage::exists($currentCover)) {
            Storage::delete($currentCover);
        }
    }

    // Update the category with the prepared data
    $model->update($data);

    // Redirect back to the categories index route with a success message
    return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã được cập nhật thành công.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        if ($category->cover && Storage::exists($category->cover)) {
            Storage::delete($category->cover);
        }

        $category->delete();

        return back()->with('success', 'Category and cover image deleted successfully.');
    }
}