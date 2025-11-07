<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;


trait HasSearchAny
{

    public function searchAny(Builder $builder, array $selectCols, string $value, array $columns)
    {
        return $builder
            ->select($selectCols)
            ->whereAny($columns, 'like', '%' . $value . '%')
            ->paginate(10);
    }
}
