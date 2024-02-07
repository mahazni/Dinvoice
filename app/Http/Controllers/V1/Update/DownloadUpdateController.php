<?php

namespace Dinvoice\Http\Controllers\V1\Update;

use Dinvoice\Http\Controllers\Controller;
use Dinvoice\Space\Updater;
use Illuminate\Http\Request;

class DownloadUpdateController extends Controller
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
            'version' => 'required',
        ]);

        $path = Updater::download($request->version);

        return response()->json([
            'success' => true,
            'path' => $path
        ]);
    }
}
