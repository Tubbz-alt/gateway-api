<?php

namespace App\Http\Controllers;

use App\Services\Validation\TemplateValidatorService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ExampleController extends Controller
{
    /**
     * @var TemplateValidatorService $validationService
     */
    private TemplateValidatorService $validationService;

    /**
     * Create a new controller instance.
     *
     * @param TemplateValidatorService $validationService
     */
    public function __construct(TemplateValidatorService $validationService)
    {
        $this->validationService = $validationService;
    }

    /**
     * @param Request $request
     */
    public function ntlmExample(Request $request)
    {
        $res =  \App\Services\NTLMRequestService::instantiate()->sendGetRequest('');

        dd($res);
    }

    /**
     * @param Request $request
     * @throws ValidationException
     */
    public function referralOrderValidationExample(Request $request)
    {
        $validatedData = $this->validationService->validate($request, 'ReferralOrder');

        dd($validatedData);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function testsSetValidationExample(Request $request)
    {
        $validatedData = $this->validationService->validate($request, 'TestsSet');

        return response()->json(['status' => 'success'] + $validatedData);
    }
}
