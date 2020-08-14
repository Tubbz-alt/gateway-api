<?php

namespace App\Services\Validation\TemplateValidators;

use App\Services\Validation\Rules\ReferralOrder\ServicesRule;
use App\Services\Validation\TemplateValidatorInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class ReferralOrderTemplate
 * @package App\Services\Validation\TemplateValidators
 */
class ReferralOrderTemplateValidator extends BaseTemplateValidator implements TemplateValidatorInterface
{
    /**
     * @return array
     */
    private function getRules(): array
    {
        return [
            "webOrderId" => ['required', 'min:11', 'numeric'],
            "location_id" => ['required', 'integer'],
            "last_name" => ['required', 'string'],
            "first_name" => ['required', 'string'],
            "middle_name" => ['required', 'string'],
            "birthday" => ['required', 'date', 'date_format:d.m.Y', 'before_or_equal:today'],
            "sex" => ['required', 'in:0,1'],
            "phone" => ['required', 'string', 'size:12'],
            "email" => ['string', 'email'],
            "services" => ['required', 'array', new ServicesRule()],
            "is_online" => ['required', 'boolean'],
            "discount_code" => ['required', 'string'],
            "residence" => ['required', 'string'],
            "job_placement" => ['required', 'string']
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
