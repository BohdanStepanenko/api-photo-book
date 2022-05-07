<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backend\UserCollection as ResourcesUserCollection;
use App\Models\User;

class AdminController extends Controller
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
}
