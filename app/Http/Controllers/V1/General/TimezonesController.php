<?php

namespace Dinvoice\Http\Controllers\V1\General;

use Dinvoice\Http\Controllers\Controller;
use Dinvoice\Space\TimeZones;
use Illuminate\Http\Request;

class TimezonesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return response()->json([
            'time_zones' => TimeZones::get_list()
        ]);
    }
}
