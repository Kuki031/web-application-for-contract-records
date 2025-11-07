<?php

namespace App\Traits;

use Carbon\Carbon;

trait HasDate
{
    public function getCreateDateFormattedAttribute(string $date)
    {
        return Carbon::parse($date)->format("d.m.Y");
    }
}
