<?php

namespace Dinvoice\Http\Controllers\V1\Settings;

use Dinvoice\Models\CompanySetting;
use Dinvoice\Http\Controllers\Controller;
use Dinvoice\Http\Requests\UpdateSettingsRequest;

class UpdateCompanySettingsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\UpdateSettingsRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(UpdateSettingsRequest $request)
    {
        CompanySetting::setSettings($request->settings, $request->header('company'));

        return response()->json([
            'success' => true
        ]);
    }
}
