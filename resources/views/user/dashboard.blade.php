<x-header />
<x-flash />

<div class="dashboard-wrap">
    <div class="dashboard-main">
        <div>
            <div class="dashboard-item">
                <h1>Dobrodošao/la {{ Auth::user()->username }}!</h1>
            </div>
            <div class="dashboard-item">
                @for ($i = 0; $i < sizeof($result); $i++)
                    <x-table-dashboard :result="$result[$i]['first_three']" :count="$result[$i]['count']" :name="$result[$i]['name']" :route="$result[$i]['route']" />
                @endfor

            </div>
        </div>
    </div>
</div>
