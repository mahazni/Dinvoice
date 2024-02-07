<?php

namespace Dinvoice\Http\Controllers\V1\General;

use Dinvoice\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dinvoice\Models\Currency;
use Dinvoice\Models\Country;
use Auth;
use Dinvoice\Models\CompanySetting;
use Dinvoice\Models\CustomField;

class BootstrapController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();

        $default_language = $user->getSettings(['language'])['language'];

        $settings = [
            'moment_date_format',
            'carbon_date_format',
            'fiscal_year',
            'time_zone',
            'currency'
        ];

        $settings = CompanySetting::getSettings($settings, $user->company_id);

        $default_currency = Currency::findOrFail($settings['currency']);

        return response()->json([
            'user' => $user,
            'company' => $user->company,
            'currencies' => Currency::all(),
            'countries' => Country::all(),
            'default_currency' => $default_currency,
            'default_language' => $default_language,
            'moment_date_format' => $settings['moment_date_format'],
            'carbon_date_format' => $settings['carbon_date_format'],
            'fiscal_year' => $settings['fiscal_year'],
            'time_zone' => $settings['time_zone']
        ]);
    }
}
