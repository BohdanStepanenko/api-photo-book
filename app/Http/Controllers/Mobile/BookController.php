<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookCreateRequest;
use App\Http\Requests\Book\BookShowRequest;
use App\Http\Requests\Book\BookUpdateRequest;
use App\Http\Requests\Book\BookDeleteRequest;
use App\Http\Resources\Mobile\Book\BookCollection;
use App\Http\Resources\Mobile\Book\BookResource;
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

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Book\BookCreateRequest $request
     * @return App\Http\Resources\Mobile\Book\BookResource
     */
    public function store(BookCreateRequest $request)
    {
        $article = Book::create($request->validated());

        return new BookResource($article);
    }

    /**
     * Display the specified resource.
     *
     * @param App\Http\Requests\BookShowRequest
     * @param  App\Models\Book $book
     * @return App\Http\Resources\Mobile\Book\BookResource
     */
    public function show(BookShowRequest $request, Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Book\BookUpdateRequest  $request
     * @param  App\Models\Book $book
     * @return App\Http\Resources\Mobile\Book\BookResource
     */
    public function update(BookUpdateRequest $request, Book $book)
    {
        $book->update($request->validated());

        return new BookResource($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Http\Requests\Book\BookDeleteRequest  $request
     * @param  App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookDeleteRequest $request, Book $book)
    {
        $book->delete();

        return response()->noContent();
    }
}
