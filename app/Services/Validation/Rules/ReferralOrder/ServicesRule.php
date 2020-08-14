<?php

namespace App\Services\Validation\Rules\ReferralOrder;

use Illuminate\Contracts\Validation\Rule;

/**
 * Class ServicesRule
 * @package App\Services\Validation\Rules\ReferralOrder
 */
class ServicesRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     * Example of valid array:
     * [
     *      [
     *          "code" => "2452"
     *      ],
     *      [
     *          "code" => "6001"
     *      ],
     * ]
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return array_reduce($value, fn ($carry, $item) => $carry && (count($item) === 1 && array_key_first($item) === 'code'), true);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute array is invalid. It must be in format [["code":""],["code":""]]';
    }
}
