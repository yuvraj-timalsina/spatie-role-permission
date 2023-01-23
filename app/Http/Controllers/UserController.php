<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Plank\Mediable\Facades\MediaUploader;
use Plank\Mediable\Media;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:user-index|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $users = User::with('roles', 'media')->withCount('media')->get();
        return view('user.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {

        $user = User::create($request->validationData());
        $user->assignRole($request->input('roles'));

        if ($request->hasFile('image')) {
            $media = MediaUploader::fromSource($request->file('image'))->useHashForFilename()->toDisk('uploads')->upload();
            $user->attachMedia($media, 'avatar');
        }

        flasher('User has been created successfully!', 'success');
        return to_route('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Role $role)
    {
        $roles = Role::select('name', 'id')->get();

        return view('user.create', compact('roles'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->load('media')->loadCount('media');
        $roles = Role::select('name', 'id')->get();
        $userRole = $user->roles->pluck('id')->toArray();

        return view('user.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if ($request->hasFile('image')) {
            if ($user->media()->count()) {
//                $media = Media::find($user->media->first()->id);
                MediaUploader::fromSource($request->file('image'))->useHashForFilename()->toDisk('uploads')->replace($media);
            } else {
                $media = MediaUploader::fromSource($request->file('image'))->useHashForFilename()->toDisk('uploads')->upload();
                $user->attachMedia($media, 'avatar');
            }
        }

        $user->update($request->validationData());
        $user->syncRoles($request->input('roles'));

        flasher('User has been updated successfully!', 'success');
        return to_route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        if ($user->media->count()) {
            $user->firstMedia('avatar')->delete();
        }
        $user->delete();

        flasher('User has been deleted successfully!', 'success');
        return to_route('users.index');
    }
}
