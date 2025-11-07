@props(['resource', 'thValues', 'items', 'itemFields', 'paginate', 'showDetails'])

<div class="index-table-wrap">
    <div class="index-table-hold">
        <div class="index-table-div">
            <a class="index-table-btn index-table-btn--back" href="{{ url()->previous() ?? route('dashboard') }}">
                Natrag
            </a>
            @php
                $setCreateActions = Route::has("{$resource}.create") ?? null;
                $setEditDeleteActions = Route::has("{$resource}.edit") && Route::has("{$resource}.destroy") ?? null;
                $logResource = 'log';

            @endphp
            @if ($setCreateActions)
                <a class="index-table-btn index-table-btn--new" href={{ route("{$resource}.create") }}>
                    Novo+
                </a>
            @endif
        </div>
        @if ($items->isNotEmpty())
            <div class="index-table-div">
                <table class="index-table">
                    <thead>
                        <tr>
                            @foreach ($thValues as $th)
                                <th>{{ $th }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                @foreach ($itemFields as $field)
                                    <td>
                                        {{ $item->$field }}
                                    </td>
                                @endforeach

                                @if ($setEditDeleteActions && $resource !== $logResource)
                                    <td>
                                        <x-table-actions :resource="$resource" :item="$item" :showDetails="$showDetails" />
                                    </td>
                                @endif

                                @if ($resource === $logResource && $showDetails)
                                    <td>
                                        <x-details :showDetails="$showDetails" :resource="$resource" :item="$item" />
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($paginate)
                <x-pagination :items="$items" />
            @endif
        @else
            <h2 class="fallback-index">Nema zapisa.</h2>
        @endif
    </div>
</div>
