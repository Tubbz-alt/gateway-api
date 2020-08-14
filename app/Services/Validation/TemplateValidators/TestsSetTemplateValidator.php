<?php

namespace App\Services\Validation\TemplateValidators;

use App\Models\Location;
use App\Services\Validation\Rules\TestsSet\TestsLocationRule;
use App\Services\Validation\Rules\TestsSet\TestsIncludeRule;
use App\Services\Validation\Rules\TestsSet\TestsIntakeRule;
use App\Services\Validation\TemplateValidatorInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

/**
 * Class TestsSetTemplateValidator
 * @package App\Services\Validation\TemplateValidators
 */
class TestsSetTemplateValidator extends BaseTemplateValidator implements TemplateValidatorInterface
{
    /**
     * @return array
     */
    private function getRules(): array
    {
        return [
            'location_id' => [
                'required',
                'integer',
                Rule::in(Location::getAllIdentifiers())
            ],
            'tests' => [
                'required',
                'array',
                new TestsLocationRule(),
                new TestsIncludeRule(),
                new TestsIntakeRule()
            ]
        ];
    }

    /**
     * @param Request $request
     * @return array
     * @throws ValidationException
     */
    public function handle(Request $request): array
    {
        return $this->validate($request, $this->getRules());
    }
}
