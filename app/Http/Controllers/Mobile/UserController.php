<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Mobile\User\UserResource;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return App\Http\Resources\Mobile\User\UserResource
     */
    public function show()
    {
        return new UserResource(Auth::user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\User\UserUpdateRequest $request
     * @return App\Http\Resources\Mobile\User\UserResource
     */
    public function update(UserUpdateRequest $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->update($request->validated());

        return new UserResource($user);
    }
}
