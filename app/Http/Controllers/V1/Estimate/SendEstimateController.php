<?php

namespace Dinvoice\Http\Controllers\V1\Estimate;

use Dinvoice\Http\Controllers\Controller;
use Dinvoice\Models\Estimate;
use Dinvoice\Http\Requests\SendEstimatesRequest;

class SendEstimateController extends Controller
{
    /**
    * Handle the incoming request.
    *
    * @param  \Dinvoice\Http\Requests\SendEstimatesRequest  $request
    * @return \Illuminate\Http\JsonResponse
    */
    public function __invoke(SendEstimatesRequest $request, Estimate $estimate)
    {
        $response = $estimate->send($request->all());

        return response()->json($response);
    }
}
