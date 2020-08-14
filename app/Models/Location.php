<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Location
 * @package App\Models
 */
class Location extends Model
{
    /**
     * @var string
     */
    protected $table = 'locations';

    /**
     * @return array
     */
    public static function getAllIdentifiers(): array
    {
        return self::select(['original_id'])->get()->pluck('original_id')->toArray();
    }
}
