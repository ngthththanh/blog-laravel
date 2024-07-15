<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    const PATH_VIEW = 'admin.users.';
    const PATH_UPLOAD = 'users';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::latest('id')->get();
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
        $data = $request->except('avatar');

        if ($request->hasFile('avatar')) {
            $data['avatar'] = Storage::put(self::PATH_UPLOAD, $request->file('avatar'));
        }

        User::query()->create($data);

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view(self::PATH_VIEW . __FUNCTION__, compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Get all data from the request except the 'avatar' field
        $data = $request->except('avatar');

        // Check if there's a file uploaded for 'avatar'
        if ($request->hasFile('avatar')) {
            // Store the current avatar path
            $currentAvatar = $user->avatar;

            // Store the new 'avatar' file in storage and update the path in the database
            $data['avatar'] = Storage::put(self::PATH_UPLOAD, $request->file('avatar'));

            // Delete the old avatar file if it exists and is not the default one
            if ($currentAvatar && $currentAvatar !== 'default.jpg' && Storage::exists($currentAvatar)) {
                Storage::delete($currentAvatar);
            }
        }

        // Update the user's data in the database
        $user->update($data);

        // Redirect back to the user list page
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Check and delete the avatar from storage if it exists
        if ($user->avatar && Storage::exists($user->avatar)) {
            Storage::delete($user->avatar);
        }

        // Delete the user
        $user->delete();

        return back()->with('success', 'User and avatar deleted successfully.');
    }
}