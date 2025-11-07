@props(['result', 'count', 'name', 'route'])

<div class="cards-container">
    <div class="card-header">
        <a href="{{ $route ? route($route) : url('#') }}" class="card-title">{{ $name }}</a>
    </div>

    <div class="cards-list">
        @foreach ($result as $item)
            <div class="card-item">
                {{ $item->price ? $item->price . ' ' . $item->currency : $item->name }}
            </div>
        @endforeach

        <div class="card-item card-item--more">
            I još {{ $count - sizeof($result) }}
        </div>
    </div>
</div>
