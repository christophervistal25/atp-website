<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuickStat extends Model
{
    protected $fillable = [
        'surigao_confirmed',
        'surigao_recovered',
        'surigao_deaths',

        'philippines_confirmed',
        'philippines_recovered',
        'philippines_deaths',

        'world_wide_confirmed',
        'world_wide_recovered',
        'world_wide_deaths',
    ];
}
