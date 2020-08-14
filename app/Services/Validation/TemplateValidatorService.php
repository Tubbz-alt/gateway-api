<?php

namespace App\Services\Validation;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class TemplateValidatorService
 * @package App\Services\Validation
 */
class TemplateValidatorService
{
    /**
     * @param Request $request
     * @param string $templateName
     * @return array
     * @throws ValidationException
     */
    public function validate(Request $request, string $templateName)
    {
        return $this->getValidatorInstance($templateName)->handle($request);
    }

    /**
     * @param string $templateName
     * @return TemplateValidatorInterface
     */
    private function getValidatorInstance(string $templateName): TemplateValidatorInterface
    {
        $templateValidatorClassname = "App\\Services\\Validation\\TemplateValidators\\{$templateName}TemplateValidator";

        return new $templateValidatorClassname();
    }
}
