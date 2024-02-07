<?php

namespace Dinvoice\Http\Controllers\V1\Update;

use Dinvoice\Http\Controllers\Controller;
use Dinvoice\Space\Updater;
use Illuminate\Http\Request;

class MigrateUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        Updater::migrateUpdate();

        return response()->json([
            'success' => true
        ]);
    }
}
