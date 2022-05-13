<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\AddressCreateRequest;
use App\Http\Requests\Address\AddressShowRequest;
use App\Http\Requests\Address\AddressUpdateRequest;
use App\Http\Requests\Address\AddressDeleteRequest;
use App\Http\Resources\Mobile\Address\AddressCollection;
use App\Http\Resources\Mobile\Address\AddressResource;
use App\Models\Address;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\Mobile\Address\AddressCollection
     */
    public function index()
    {
        $addresses = Address::where('user_id', '=', auth()->user()->id)->paginate();

        return new AddressCollection($addresses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Address\AddressCreateRequest $request
     * @return App\Http\Resources\Mobile\Address\AddressResource
     */
    public function store(AddressCreateRequest $request)
    {
        $address = Address::create($request->validated());

        return new AddressResource($address);
    }

    /**
     * Display the specified resource.
     *
     * @param App\Http\Requests\AddressShowRequest
     * @param  App\Models\Address $address
     * @return App\Http\Resources\Mobile\Address\AddressResource
     */
    public function show(AddressShowRequest $request, Address $address)
    {
        return new AddressResource($address);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Address\AddressUpdateRequest  $request
     * @param  App\Models\Address $address
     * @return App\Http\Resources\Mobile\Address\AddressResource
     */
    public function update(AddressUpdateRequest $request, Address $address)
    {
        $address->update($request->validated());

        return new AddressResource($address);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Http\Requests\Address\AddressDeleteRequest  $request
     * @param  App\Models\Address $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(AddressDeleteRequest $request, Address $address)
    {
        $address->delete();

        return response()->noContent();
    }
}
