@props(['resource', 'item', 'showDetails'])

@php
    $contractResource = 'contract';
@endphp

<div class="index-table-actions">
    <a href={{ route("{$resource}.edit", [$item]) }}>
        <button class="index-table-btn index-table-btn--update">Ažuriraj</button>
    </a>
        <form class="delete-resource" action={{ route("{$resource}.destroy", [$item]) }} method="post">
            @csrf
            @method('DELETE')
            <button class="index-table-btn index-table-btn--delete" type="submit">Obriši</button>
        </form>
    @if ($showDetails)
        <a href={{ route("{$resource}.show", [$item]) }}>
            <button class="index-table-btn index-table-btn--details">Detalji</button>
        </a>
    @endif
    @if ($resource === $contractResource)
        <x-contract.actions :item="$item" />
    @endif
</div>
