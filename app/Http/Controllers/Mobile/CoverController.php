<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Cover\CoverCreateRequest;
use App\Http\Requests\Cover\CoverShowRequest;
use App\Http\Requests\Cover\CoverDeleteRequest;
use App\Http\Resources\Mobile\Cover\CoverResource;
use App\Models\Cover;

class CoverController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Cover\CoverCreateRequest  $request
     * @return App\Http\Resources\Mobile\Cover\CoverResource
     */
    public function store(CoverCreateRequest $request)
    {
        $file = $request->file('cover');
        $file_name = $file->getClientOriginalName();
        $file_path = 'user/covers/' . auth()->user()->id;

        Storage::putFileAs($file_path, $file, $file_name);

        $photo = Cover::create(
            array_merge(
                $request->validated(),
                ['path' => $file_path . '/' . $file_name]
            )
        );

        return new CoverResource($photo);
    }

    /**
     * Display the specified resource.
     * 
     * @param App\Http\Requests\Cover\CoverShowRequest
     * @param App\Models\Cover $cover
     *
     * @return App\Http\Resources\Mobile\Cover\CoverResource
     */
    public function show(CoverShowRequest $request, Cover $cover)
    {
        return new CoverResource($cover);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Http\Requests\Cover\CoveroDeleteRequest
     * @param App\Models\Cover $cover
     * @return \Illuminate\Http\Response
     */
    public function destroy(CoverDeleteRequest $request, Cover $cover)
    {
        Storage::delete($cover->path);
        $cover->delete();

        return response()->noContent();
    }
}
