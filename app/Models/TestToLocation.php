<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TestToLocation
 * @package App\Models
 */
class TestToLocation extends Model
{
    /**
     * @var string
     */
    protected $table = 'test_to_location';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @param array $tests
     * @param int $locationId
     * @return array
     */
    public static function getTestsAvailableInGivenLocations(array $tests, int $locationId): array
    {
        return self::join('tests as t', 'test_to_location.sy_test_id', '=', 't.sy_test_id')
            ->whereIn('t.code', $tests)
            ->where('test_to_location.location_id', $locationId)
            ->select(['t.code'])
            ->pluck('code')
            ->toArray();
    }
}
