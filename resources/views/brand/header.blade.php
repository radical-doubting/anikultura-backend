@push('head')
    <link href="/img/ani-logo-color.png" type="image/png" rel="icon">
@endpush

<p class="h2 n-m font-thin v-center">
    <img src="/img/ani-logo-{{ Route::currentRouteName() === 'platform.login' ? 'color' : 'white' }}.png"
        style="margin-right: 0.5em" width=52>

    <span class="m-l d-none d-sm-block" style="font-size: 0.8em; line-height: 0.9em;">
        Anikultura<br>
        <small class="opacity">Management Dashboard</small>
    </span>
</p>
