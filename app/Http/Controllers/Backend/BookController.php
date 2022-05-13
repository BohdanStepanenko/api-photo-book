<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backend\Book\BookCollection;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\Backend\Book\BookCollection
     */
    public function index()
    {
        return new BookCollection(Book::paginate());
    }
}
