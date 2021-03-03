<?php

namespace App\Http\Controllers\Repositories;

use App\PersonLog;

class PersonLogRepository
{
    public static function getLogsByTemperatureRange(float $min, float $max)
    {
        return PersonLog::where('body_temperature', '>=', $min)
                        ->where('body_temperature', '<=', $max)
                        ->count();
    }
}

