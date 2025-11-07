<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait HasTable
{
    public function fillIndexTableVariables(
        $resource,
        array $thValues,
        array $itemFields,
        bool $paginate = true,
        bool $showDetails = true,
        array|string|null $items = null,
    ) {
        return [
            "resource" => $resource,
            "thValues" => $thValues,
            "itemFields" => $itemFields,
            "paginate" => $paginate,
            "showDetails" => $showDetails,
            "items" => $items,
        ];
    }

    public function fillShowTable(
        string $route,
        Model|string $item,
        array $tdNames,
        array $tdValues,
    ) {
        return [
            "route" => $route,
            "item" => $item,
            "tdNames" => $tdNames,
            "tdValues" => $tdValues,
        ];
    }

    public function fillFormComponentData(
        string $route,
        Model|string|null $item = null,
        array|Collection|null $clients = null,
        array|Collection|null $services = null,
        array|Collection|null $prices = null,
        array|Collection|null $templates = null,
        array|Collection|null $hostings = null,
        array|Collection|null $domains = null
    ) {
        return [
            "route" => $route,
            "item" => $item,
            "clients" => $clients,
            "services" => $services,
            "prices" => $prices,
            "templates" => $templates,
            "hostings" => $hostings,
            "domains" => $domains
        ];
    }
}
