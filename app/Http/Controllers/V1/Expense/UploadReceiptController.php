<?php

namespace Dinvoice\Http\Controllers\V1\Expense;

use Dinvoice\Models\Expense;
use Dinvoice\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadReceiptController extends Controller
{
    /**
     * Upload the expense receipts to storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Expense $expense
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, Expense $expense)
    {
        $data = json_decode($request->attachment_receipt);

        if ($data) {
            if ($request->type === 'edit') {
                $expense->clearMediaCollection('receipts');
            }

            $expense->addMediaFromBase64($data->data)
                ->usingFileName($data->name)
                ->toMediaCollection('receipts', 'local');
        }

        return response()->json([
            'success' => 'Expense receipts uploaded successfully'
        ]);
    }
}
