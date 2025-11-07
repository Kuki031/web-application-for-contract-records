@props(['route', 'item', 'clients', 'services', 'prices', 'templates', 'domains'])


<div class="form-wrap">
    <div>
        <a class="show-table-btn show-table-btn--back" href="{{ url()->previous() ?? route('dashboard') }}">Nazad</a>
        <form class="form"
            action="{{ isset($item) && $item->exists ? route("{$route}.update", $item) : route("{$route}.store") }}"
            method="post">
            @include("{$route}._form")
        </form>
    </div>
</div>
