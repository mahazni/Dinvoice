<?php

use Dinvoice\Http\Requests\InvoicesRequest;
use Dinvoice\Models\Invoice;
use Dinvoice\Rules\UniqueNumber;

test('invoice request validation rules', function () {
    $request = new InvoicesRequest;

    $this->assertEquals([
            'invoice_date' => [
                'required'
            ],
            'due_date' => [
                'required'
            ],
            'user_id' => [
                'required'
            ],
            'discount' => [
                'required'
            ],
            'discount_val' => [
                'required'
            ],
            'sub_total' => [
                'required'
            ],
            'total' => [
                'required'
            ],
            'tax' => [
                'required'
            ],
            'invoice_template_id' => [
                'required'
            ],
            'items' => [
                'required',
                'array'
            ],
            'items.*' => [
                'required',
                'max:255'
            ],
            'items.*.description' => [
                'max:255'
            ],
            'items.*.name' => [
                'required'
            ],
            'items.*.quantity' => [
                'required'
            ],
            'items.*.price' => [
                'required'
            ],
            'invoice_number' => [
                'required',
                new UniqueNumber(Invoice::class)
            ],
        ],
        $request->rules()
    );
});

test('invoices request authorize', function () {
    $request = new InvoicesRequest;

    $this->assertTrue($request->authorize());
});
