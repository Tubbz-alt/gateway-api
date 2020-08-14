<?php

namespace App\Services\Validation\TemplateValidators;

use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

/**
 * Class BaseTemplateValidator
 * @package App\Services\Validation\TemplateValidators
 */
class BaseTemplateValidator
{
    use ProvidesConvenienceMethods;

    /**
     * @return string
     */
    public function getClassname(): string
    {
        return class_basename(static::class);
    }
}
