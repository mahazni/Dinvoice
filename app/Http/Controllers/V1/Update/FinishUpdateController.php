<?php

namespace Dinvoice\Http\Controllers\V1\Update;

use Dinvoice\Http\Controllers\Controller;
use Dinvoice\Space\Updater;
use Illuminate\Http\Request;

class FinishUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'installed' => 'required',
            'version' => 'required',
        ]);

        $json = Updater::finishUpdate($request->installed, $request->version);

        return response()->json($json);
    }
}
