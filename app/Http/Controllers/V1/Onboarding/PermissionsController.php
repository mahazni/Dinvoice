<?php

namespace Dinvoice\Http\Controllers\V1\Onboarding;

use Dinvoice\Space\PermissionsChecker;
use Illuminate\Http\JsonResponse;
use Dinvoice\Http\Controllers\Controller;

class PermissionsController extends Controller
{
    /**
     * @var PermissionsChecker
     */
    protected $permissions;

    /**
     * @param PermissionsChecker $checker
     */
    public function __construct(PermissionsChecker $checker)
    {
        $this->permissions = $checker;
    }

    /**
     * Display the permissions check page.
     *
     * @return JsonResponse
     */
    public function permissions()
    {
        $permissions = $this->permissions->check(
            config('installer.permissions')
        );

        return response()->json([
            'permissions' => $permissions
        ]);
    }
}
