<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderCreateRequest;
use App\Http\Requests\Order\OrderShowRequest;
use App\Http\Resources\Mobile\Order\OrderResource;
use App\Models\PaymentMethod;
use App\Models\Order;
use App\Models\Book;

class OrderController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Order\OrderCreateRequest $request
     * @return App\Http\Resources\Mobile\Order\OrderResource
     */
    public function store(OrderCreateRequest $request)
    {
        $selected_book = Book::findOrFail($request->book_id);
        $selected_payment = PaymentMethod::findOrFail($request->payment_method);

        $price_including_pages = $selected_book->pages == 50 ? 30 : 50;
        $price_including_cover = $selected_book->cover_id < 3 ? 0 : 10;
        $amount = $price_including_pages + $price_including_cover;

        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        $stripe->customers->createSource(
            $selected_payment->customer_token,
            ['source' => 'tok_visa']
        );

        $payment = $stripe->charges->create([
            'currency' => 'usd',
            'amount' => $amount,
            'customer' => $selected_payment->customer_token,
        ]);

        $order = Order::create(
            array_merge(
                $request->validated(),
                ['amount' => $amount]
            )
        );

        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     *
     * @param App\Http\Requests\OrderShowRequest
     * @param  App\Models\Order $order
     * @return App\Http\Resources\Mobile\Order\OrderResource
     */
    public function show(OrderShowRequest $request, $id)
    {
        $order = Order::findOrFail($id);

        return new OrderResource($order);
    }
}
