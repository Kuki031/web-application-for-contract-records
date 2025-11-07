@props(['route', 'item'])

<td>Akcije:</td>
<td>
    <div class="show-table-actions">
        <a href="{{ route("{$route}.edit", [$item]) }}">
            <button class="show-table-btn show-table-btn--update">Ažuriraj</button>
        </a>

        <form class="delete-resource" action="{{ route("{$route}.destroy", $item) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="show-table-btn show-table-btn--delete" type="submit">Obriši</button>
        </form>
    </div>
</td>
