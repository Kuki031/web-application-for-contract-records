@if (session('success'))
    <div class="flash flash__success">
        {{ session('success') }}
    </div>
@endif

@if (session('fail'))
    <div class="flash flash__fail">
        {{ session('fail') }}
    </div>
@endif
