@props(['showDetails', 'resource', 'item'])

@if ($showDetails)
    <a href={{ route("{$resource}.show", [$item]) }}>
        <button class="index-table-btn index-table-btn--details">Detalji</button>
    </a>
@endif
