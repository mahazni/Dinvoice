<?php

namespace Dinvoice\Http\Controllers\V1\Onboarding;

use Dinvoice\Space\RequirementsChecker;
use Illuminate\Http\JsonResponse;
use Dinvoice\Http\Controllers\Controller;

class RequirementsController extends Controller
{
    /**
     * @var RequirementsChecker
     */
    protected $requirements;

    /**
     * @param RequirementsChecker $checker
     */
    public function __construct(RequirementsChecker $checker)
    {
        $this->requirements = $checker;
    }

    /**
     * Display the requirements page.
     *
     * @return JsonResponse
     */
    public function requirements()
    {
        $phpSupportInfo = $this->requirements->checkPHPversion(
            config('installer.core.minPhpVersion')
        );
        $requirements = $this->requirements->check(
            config('installer.requirements')
        );

        return response()->json([
            'phpSupportInfo' => $phpSupportInfo,
            'requirements' => $requirements
        ]);
    }
}
