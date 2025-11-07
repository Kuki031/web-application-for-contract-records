<x-header />
<x-flash />
<x-search-bar :resource="$resource"/>
<x-index-table :resource="$resource" :thValues="$thValues" :items="$items" :itemFields="$itemFields" :paginate="$paginate" :showDetails="$showDetails"/>
