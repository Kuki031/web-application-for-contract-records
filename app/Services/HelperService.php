<?php

namespace App\Services;

use Carbon\Carbon;
use Exception;

class HelperService
{

    public function sanitizeFilename($name)
    {
        return preg_replace('/[^A-Za-z0-9_\-]/', '_', $name);
    }

    public function getData($model, $columns)
    {
        return $model::select($columns)->get();
    }


    public static function formatDate($value)
    {
        if (is_bool($value) || is_integer($value) || is_null($value)) {
            return $value;
        }


        try {
            $carbonDate = Carbon::parse($value);

            if ($carbonDate->format('H:i:s') === '00:00:00') {
                return $carbonDate->format('d.m.Y');
            }

            return $carbonDate->format('d.m.Y H:i:s');
        } catch (Exception) {
            return $value;
        }
    }
}
