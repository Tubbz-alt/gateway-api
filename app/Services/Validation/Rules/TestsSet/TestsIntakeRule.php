<?php

namespace App\Services\Validation\Rules\TestsSet;

use App\Models\TestsIntake;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

/**
 * Class TestsIntakeRule
 * @package App\Services\Validation\Rules\TestsSet
 */
class TestsIntakeRule implements Rule
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
        $neededIntakes = TestsIntake::getIntakesForGivenCodes($value);

        $missingIntakes = array_diff($neededIntakes, $value);

        if (empty($missingIntakes)) {
            return true;
        } else {
            $this->setMessage($attribute, $missingIntakes);
            return false;
        }
    }

    /**
     * @param string $attribute
     * @param array $missedIntakes
     * @return void
     */
    private function setMessage(string $attribute, array $missedIntakes)
    {
        array_walk($missedIntakes, fn (&$value, $key) => $value = "{$value} is needed for test {$key}");

        $missedIntakes = implode(', ', $missedIntakes);

        $this->message = "The {$attribute} array is invalid. Intakes missing: {$missedIntakes}.";
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
