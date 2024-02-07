<?php

use Dinvoice\Http\Requests\PaymentRequest;
use Dinvoice\Models\Payment;
use Dinvoice\Rules\UniqueNumber;

test('payment request validation rules', function () {
    $request = new PaymentRequest;

    $this->assertEquals([
            'payment_date' => [
                'required'
            ],
            'user_id' => [
                'required'
            ],
            'amount' => [
                'required'
            ],
            'payment_number' => [
                'required',
                new UniqueNumber(Payment::class)
            ],
            'invoice_id' => [
                'nullable',
            ],
            'payment_method_id' => [
                'nullable',
            ],
            'notes' => [
                'nullable',
            ],
        ],
        $request->rules()
    );
});

test('payment request authorize', function () {
    $request = new PaymentRequest;

    $this->assertTrue($request->authorize());
});
