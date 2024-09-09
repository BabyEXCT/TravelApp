<div id="loading">
    @include('Admin.dashboard._body_loader')
</div>
<main class="main-content">
@include('Admin.dashboard._body_header3')
    <div class="conatiner-fluid content-inner pb-0">
    {{ $slot }}
    </div>
    @include('Admin.dashboard._body_footer')
</main>
@include('Admin.dashboard._scripts')
