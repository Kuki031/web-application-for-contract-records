<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

trait HasFilterColumns
{

    public function filter(Model|string $model, array $filterCols)
    {
        if (is_string($model)) {
            $model = new $model;
        }

        $columns = Schema::getColumnListing($model->getTable());

        $filtered = array_filter($columns, function($col) use ($filterCols) {
            return !in_array($col, $filterCols);
        });

        return array_values($filtered);
    }
}
