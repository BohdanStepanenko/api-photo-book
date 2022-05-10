<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Photo\CreateRequest;
use App\Http\Requests\Photo\ShowRequest;
use App\Http\Requests\Photo\DeleteRequest;
use App\Http\Resources\Mobile\PhotoResource;
use App\Models\Photo;

class PhotoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Photo\CreateRequest  $request
     * @return App\Http\Resources\Mobile\PhotoResource
     */
    public function store(CreateRequest $request)
    {
        $file = $request->file('photo');
        $file_name = $file->getClientOriginalName();
        $file_path = auth()->user()->id . '/books/' . $request->book_id;

        Storage::putFileAs($file_path, $file, $file_name);

        $photo = Photo::create(
            array_merge(
                $request->validated(),
                ['path' => $file_path . '/' . $file_name]
            )
        );

        return new PhotoResource($photo);
    }

    /**
     * Display the specified resource.
     * 
     * @param App\Http\Requests\Photo\ShowRequest
     * @param App\Models\Photo $photo
     *
     * @return App\Http\Resources\Mobile\PhotoResource
     */
    public function show(ShowRequest $request, Photo $photo)
    {
        return new PhotoResource($photo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Http\Requests\Photo\DeleteRequest
     * @param App\Models\Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteRequest $request, Photo $photo)
    {
        Storage::delete($photo->path);
        $photo->delete();

        return response()->noContent();
    }
}
