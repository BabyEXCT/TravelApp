<div id="loading">
    @include('user.dashboard._body_loader')
</div>
<main class="main-content">
@include('user.dashboard._body_header4')
    <div class="conatiner-fluid content-inner pb-0">
    {{ $slot }}
    </div>
    @include('user.dashboard._body_footer')
</main>
@include('user.dashboard._scripts')
