<?php

namespace App\Services\Validation;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Interface TemplateValidatorInterface
 * @package App\Services\Validation
 */
interface TemplateValidatorInterface
{
    /**
     * Validate the given request with the rules set stored in class.
     *
     * @param Request $request
     * @return array
     * @throws ValidationException
     */
    public function handle(Request $request): array;

    /**
     * Get the class "basename" of the class.
     *
     * @return string
     */
    public function getClassname(): string;
}
