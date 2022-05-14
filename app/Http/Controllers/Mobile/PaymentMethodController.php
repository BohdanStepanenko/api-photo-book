<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentMethod\PaymentMethodCreateRequest;
use App\Models\PaymentMethod;
use App\Http\Resources\Mobile\PaymentMethod\PaymentMethodResource;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PaymentMethod\PaymentMethodCreateRequest $request
     * @return App\Http\Resources\Mobile\PaymentMethod\PaymentMethodResource
     */
    public function store(PaymentMethodCreateRequest $request)
    {
        list($expiration_month, $expiration_year) = explode('/', $request->expiration_date);

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $stripe->tokens->create([
            'card' => [
                'name' => $request->card_owner,
                'number' => $request->card_number,
                'exp_month' => $expiration_month,
                'exp_year' => $expiration_year,
                'cvc' => $request->cvc,
            ],
        ]);

        $payment_method = PaymentMethod::create($request->validated());

        return new PaymentMethodResource($payment_method);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
