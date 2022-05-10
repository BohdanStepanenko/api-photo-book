<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Http\Resources\Backend\User\UserCollection;
use App\Http\Resources\Backend\User\UserResource;
use App\Http\Requests\User\CreateRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\Backend\User\UserCollection
     */
    public function index()
    {
        return new UserCollection(User::paginate());
    }

    /**
     * Create new admin.
     *
     * @param  App\Http\Requests\Book\CreateRequest $request
     * @return App\Http\Resources\Mobile\BookResource
     */
    public function store(CreateRequest $request)
    {
        $admin = User::create(
            array_merge(
                $request->validated(),
                ['password' => Hash::make($request->password)]
            )
        );

        $admin->createToken('auth_token')->plainTextToken;
        $admin->assignRole('admin');

        return new UserResource($admin);
    }

    /**
     * Remove admin.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->hasRole('admin')) {
            $user->delete();
        }

        return response()->noContent();
    }
}
