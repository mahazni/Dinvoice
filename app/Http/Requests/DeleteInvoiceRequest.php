<?php

namespace Dinvoice\Http\Requests;

use Dinvoice\Models\Invoice;
use Dinvoice\Rules\RelationNotExist;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DeleteInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ids' => [
                'required'
            ],
            'ids.*' => [
                'required',
                Rule::exists('invoices', 'id'),
                new RelationNotExist(Invoice::class, 'payments')
            ]
        ];
    }
}
