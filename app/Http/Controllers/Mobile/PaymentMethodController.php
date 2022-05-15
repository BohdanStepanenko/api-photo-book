<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentMethod\PaymentMethodCreateRequest;
use App\Http\Requests\PaymentMethod\PaymentMethodShowRequest;
use App\Http\Requests\PaymentMethod\PaymentMethodDeleteRequest;
use App\Http\Resources\Mobile\PaymentMethod\PaymentMethodCollection;
use App\Http\Resources\Mobile\PaymentMethod\PaymentMethodResource;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\Mobile\PaymentMethod\PaymentMethodCollection
     */
    public function index()
    {
        $payment_method = PaymentMethod::where('user_id', auth()->user()->id)->paginate();

        return new PaymentMethodCollection($payment_method);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PaymentMethod\PaymentMethodCreateRequest  $request
     * @return App\Http\Resources\Mobile\PaymentMethod\PaymentMethodResource
     */
    public function store(PaymentMethodCreateRequest $request)
    {
        list($expiration_month, $expiration_year) = explode('/', $request->expiration_date);

        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
        $token = $stripe->tokens->create([
            'card' => [
                'name' => $request->card_owner,
                'number' => $request->card_number,
                'exp_month' => $expiration_month,
                'exp_year' => $expiration_year,
                'cvc' => $request->cvc,
            ],
        ]);

        $payment_method = PaymentMethod::create(
            array_merge(
                ['last_four' => $token->card->last4],
                ['card_token' => $token->card->id]
            )
        );

        return new PaymentMethodResource($payment_method);
    }

    /**
     * Display the specified resource.
     * 
     * @param App\Http\Requests\PaymentMethod\PaymentMethodShowRequest
     * @param App\Models\PaymentMethod $payment_method
     *
     * @return App\Http\Resources\Mobile\PaymentMethod\PaymentMethodResource
     */
    public function show(PaymentMethodShowRequest $request, PaymentMethod $payment_method)
    {
        return new PaymentMethodResource($payment_method);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Http\Requests\PaymentMethod\PaymentMethodDeleteRequest
     * @param App\Models\PaymentMethod $payment_method
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethodDeleteRequest $request, PaymentMethod $payment_method)
    {
        $payment_method->delete();

        return response()->noContent();
    }
}
