<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\CreateRequest;
use App\Http\Requests\Book\ShowRequest;
use App\Http\Requests\Book\UpdateRequest;
use App\Http\Requests\Book\DeleteRequest;
use App\Http\Resources\Mobile\BookResource;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Book\CreateRequest $request
     * @return App\Http\Resources\Mobile\BookResource
     */
    public function store(CreateRequest $request)
    {
        $article = Book::create($request->validated());

        return new BookResource($article);
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Book $book
     * @return App\Http\Resources\Mobile\BookResource
     */
    public function show(ShowRequest $request, Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Book\UpdateRequest  $request
     * @param  App\Models\Book $book
     * @return App\Http\Resources\Mobile\BookResource
     */
    public function update(UpdateRequest $request, Book $book)
    {
        $book->update($request->validated());

        return new BookResource($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Http\Requests\Book\DeleteRequest  $request
     * @param  App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteRequest $request, Book $book)
    {
        $book->delete();

        return response()->noContent();
    }
}
