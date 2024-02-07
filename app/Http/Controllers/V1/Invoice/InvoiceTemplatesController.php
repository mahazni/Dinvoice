<?php

namespace Dinvoice\Http\Controllers\V1\Invoice;

use Dinvoice\Http\Controllers\Controller;
use Dinvoice\Models\InvoiceTemplate;
use Illuminate\Http\Request;

class InvoiceTemplatesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $invoiceTemplates = InvoiceTemplate::all();

        return response()->json([
            'invoiceTemplates' => $invoiceTemplates
        ]);
    }
}
