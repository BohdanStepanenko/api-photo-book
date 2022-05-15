<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderUpdateRequest;
use App\Http\Resources\Backend\Order\OrderCollection;
use App\Http\Resources\Backend\Order\OrderResource;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\Backend\Order\OrderCollection
     */
    public function index()
    {
        $orders = Order::with('books', 'users', 'addresses')->paginate();

        return new OrderCollection($orders);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Order\OrderUpdateRequest  $request
     * @param  App\Models\Order $order
     * @return App\Http\Resources\Mobile\Order\OrderResource
     */
    public function update(OrderUpdateRequest $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->validated());

        return new OrderResource($order);
    }
}
