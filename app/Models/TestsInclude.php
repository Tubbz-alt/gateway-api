<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TestsInclude
 * @package App\Models
 */
class TestsInclude extends Model
{
    /**
     * @var string
     */
    protected $table = 'tests_includes';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Return pairs of tests, where one test from given array includes
     * another one from same array, for given array of tests.
     *
     * @param array $tests
     * @return Collection
     */
    public static function getIncludingPairsOfGivenTests(array $tests): Collection
    {
        return self::whereIn('code', $tests)
            ->whereIn('include_code', $tests)
            ->select(['code', 'include_code'])
            ->get();
    }
}
