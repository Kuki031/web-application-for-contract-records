@props(['item', 'newValues', 'oldValues'])


<table class="details-table details-table-logs">
    <thead>
        <tr>
            <h3>Detalji promjena</h3>
        </tr>
        <tr>
            <th>Polje</th>
            <th>Stara vrijednost</th>
            <th>Nova vrijednost</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($newValues as $key => $value)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ \App\Services\HelperService::formatDate($oldValues[$key] ?? '—') }}</td>
                <td>{{ \App\Services\HelperService::formatDate($value) ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="modified_by-logs">
    <h4>Zadnje ažurirao/la: {{ $item->username }}</h4>
</div>
