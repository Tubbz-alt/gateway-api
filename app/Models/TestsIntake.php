<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TestsIntake
 * @package App\Models
 */
class TestsIntake extends Model
{
    /**
     * @var string
     */
    protected $table = 'tests_intake';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @param array $tests
     * @return array
     */
    public static function getIntakesForGivenCodes(array $tests): array
    {
        return self::whereIn('code', $tests)
            ->select(['code', 'intake_code'])
            ->pluck('intake_code', 'code')
            ->toArray();
    }
}
