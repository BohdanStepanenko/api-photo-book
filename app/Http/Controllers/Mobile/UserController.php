<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mobile\User\UpdateRequest;
use App\Http\Resources\Mobile\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return App\Http\Resources\Profile
     */
    public function show()
    {
        return new Profile(Auth::user());
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
}
