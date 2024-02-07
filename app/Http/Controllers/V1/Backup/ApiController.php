<?php
// Implementation taken from nova-backup-tool - https://github.com/spatie/nova-backup-tool/

namespace Dinvoice\Http\Controllers\V1\Backup;

use Dinvoice\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    /**
     *
     * @return JsonResponse
     */

    public function respondSuccess(): JsonResponse
    {
        return response()->json([
            'success' => true
        ]);
    }

}
