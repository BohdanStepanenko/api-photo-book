<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backend\UserCollection as ResourcesUserCollection;
use App\Http\Requests\Backend\User\UpdateRequest;
use App\Http\Resources\Mobile\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\Backend\UserCollection
     */
    public function index()
    {
        return new ResourcesUserCollection(User::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->update($request->validated());

        return new Profile($user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->noContent();
    }
}
