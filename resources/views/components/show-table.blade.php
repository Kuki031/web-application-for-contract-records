@props(['route', 'item', 'tdNames', 'tdValues'])

@php
    $setCreateActions = Route::has("{$route}.create");
    $setEditDeleteActions = Route::has("{$route}.edit") && Route::has("{$route}.destroy");

    $contractRoute = 'contract';
    $logRoute = 'log';

@endphp

<div class="details-wrap">
    <div class="details-main">
        <div class="details-div">
            <div class="details-actions">
                <a href="{{ url()->previous() ?? route('dashboard') }}"
                    class="show-table-btn show-table-btn--back">Natrag</a>
                @if ($setCreateActions)
                    <a href="{{ route("{$route}.create") }}" class="show-table-btn show-table-btn--new">Novo+</a>
                @endif
            </div>
        </div>

        <div class="details-div">
            <table class="details-table">
                <tbody>
                    @foreach ($tdNames as $index => $tdName)
                        @if ($route === $contractRoute)
                            <x-contract.row :tdName="$tdName" :item="$item" :tdValues="$tdValues" :index="$index" />
                        @else
                            <tr>
                                <td>{{ $tdName }}</td>
                                <td>{{ $item->{$tdValues[$index]} ?? '—' }}</td>
                            </tr>
                        @endif
                    @endforeach

                    @if ($route === $logRoute && $item->new_values)
                        <x-logs.changes :item="$item" :newValues="json_decode($item->new_values, true)" :oldValues="json_decode($item->old_values, true)" />
                    @endif

                    @if ($setEditDeleteActions)
                        <tr>
                            <x-show-table-actions :route="$route" :item="$item" />
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
