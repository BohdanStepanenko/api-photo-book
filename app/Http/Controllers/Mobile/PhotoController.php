<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Photo\PhotoCreateRequest;
use App\Http\Requests\Photo\PhotoShowRequest;
use App\Http\Requests\Photo\PhotoDeleteRequest;
use App\Http\Resources\Mobile\Photo\PhotoResource;
use App\Models\Photo;

class PhotoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Photo\PhotoCreateRequest  $request
     * @return App\Http\Resources\Mobile\Photo\PhotoResource
     */
    public function store(PhotoCreateRequest $request)
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
     * @param App\Http\Requests\Photo\PhotoShowRequest
     * @param App\Models\Photo $photo
     *
     * @return App\Http\Resources\Mobile\Photo\PhotoResource
     */
    public function show(PhotoShowRequest $request, Photo $photo)
    {
        return new PhotoResource($photo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Http\Requests\Photo\PhotoDeleteRequest
     * @param App\Models\Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhotoDeleteRequest $request, Photo $photo)
    {
        Storage::delete($photo->path);
        $photo->delete();

        return response()->noContent();
    }
}
