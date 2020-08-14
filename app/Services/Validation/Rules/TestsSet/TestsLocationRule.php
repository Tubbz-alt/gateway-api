<?php

namespace App\Services\Validation\Rules\TestsSet;

use App\Models\TestToLocation;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class TestsLocationRule
 * @package App\Services\Validation\Rules\TestsSet
 */
class TestsLocationRule implements Rule
{
    /**
     * @var string
     */
    private string $message;

    /**
     * @var int
     */
    private int $locationId;

    /**
     * TestsLocationRule constructor.
     */
    public function __construct()
    {
        $this->locationId = app('request')->input('location_id');
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $validTests = TestToLocation::getTestsAvailableInGivenLocations($value, $this->locationId);

        $invalidTests = array_diff($value, $validTests);

        if (empty($invalidTests)) {
            return true;
        } else {
            $this->setMessage($attribute, $invalidTests);
            return false;
        }
    }

    /**
     * @param string $attribute
     * @param array $invalidTests
     * @return void
     */
    private function setMessage(string $attribute, array $invalidTests)
    {
        $invalidTests = implode(', ', $invalidTests);

        $this->message = "The {$attribute} array is invalid. {$invalidTests} not available for location {$this->locationId}.";
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
