<?php

namespace App\Services\Validation\Rules\TestsSet;

use App\Models\TestsInclude;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class TestsIncludeRule
 * @package App\Services\Validation\Rules\TestsSet
 */
class TestsIncludeRule implements Rule
{
    /**
     * @var string
     */
    private string $message;

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $invalidPairs = TestsInclude::getIncludingPairsOfGivenTests($value);

        if ($invalidPairs->isEmpty()) {
            return true;
        } else {
            $this->setMessage($attribute, $invalidPairs);
            return false;
        }
    }

    /**
     * @param string $attribute
     * @param Collection $invalidPairs
     * @return void
     */
    private function setMessage(string $attribute, Collection $invalidPairs)
    {
        $invalidPairs = $invalidPairs
            ->map(fn (&$value, $key) => $value = "{$value->code} includes {$value->include_code}")
            ->toArray();

        $invalidPairs = implode(', ', $invalidPairs);

        $this->message = "The {$attribute} array is invalid. Test {$invalidPairs}.";
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return $this->message;
    }
}
