@props(['resource'])

<div class="search-bar-wrap">
    <form class="search-bar" action="{{ route($resource . '.index') }}" method="get">
        <input type="search" name="value" placeholder="Pretraži...">
    </form>
</div>
