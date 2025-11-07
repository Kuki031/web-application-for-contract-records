<x-header />
<x-flash />

<div class="main-wrapper">
    <x-show-table :route="$route" :item="$item" :tdNames="$tdNames" :tdValues="$tdValues" />
    <x-morph-note :notes="$notes" :resource="$route" :item="$item"/>
</div>
