<?php

namespace Dinvoice\Http\Controllers\V1\Update;

use Dinvoice\Http\Controllers\Controller;
use Dinvoice\Models\Setting;
use Dinvoice\Space\Updater;
use Illuminate\Http\Request;

class CheckVersionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        set_time_limit(600); // 10 minutes

        $json = Updater::checkForUpdate(Setting::getSetting('version'));

        return response()->json($json);
    }
}
