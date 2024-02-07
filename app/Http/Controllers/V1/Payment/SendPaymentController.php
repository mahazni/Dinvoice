<?php

namespace Dinvoice\Http\Controllers\V1\Payment;

use Dinvoice\Http\Controllers\Controller;
use Dinvoice\Models\Payment;
use Dinvoice\Http\Requests\SendPaymentRequest;

class SendPaymentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(SendPaymentRequest $request, Payment $payment)
    {
        $response = $payment->send($request->all());

        return response()->json($response);
    }
}
