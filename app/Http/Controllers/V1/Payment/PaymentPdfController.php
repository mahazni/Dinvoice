<?php

namespace Dinvoice\Http\Controllers\V1\Payment;

use Dinvoice\Http\Controllers\Controller;
use Dinvoice\Models\Payment;

class PaymentPdfController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Payment $payment)
    {
        return $payment->getGeneratedPDFOrStream('payment');
    }
}
