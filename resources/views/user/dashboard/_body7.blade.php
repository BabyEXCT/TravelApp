

<div id="loading">
    @include('user.dashboard._body_loader')
</div>
<div class="wrapper">
    {{ $slot }}
</div>
@include('user.dashboard._body_footer')
@include('user.dashboard._scripts')
