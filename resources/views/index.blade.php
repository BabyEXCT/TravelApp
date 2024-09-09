<x-app-layout layout="simple" :assets="$assets ?? []">
    <span class="uisheet screen-darken"></span>

    <!-- Header Section -->
    <div class="header" style="background: url({{ asset('images/dashboard/top-image.jpg') }}); background-size: cover; background-repeat: no-repeat; height: 100vh; position: relative;">
        <div class="main-img">
            <div class="container text-center">
                <svg width="150" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="-0.423828" y="34.5762" width="50" height="7.14286" rx="3.57143" transform="rotate(-45 -0.423828 34.5762)" fill="white"/>
                    <rect x="14.7295" y="49.7266" width="50" height="7.14286" rx="3.57143" transform="rotate(-45 14.7295 49.7266)" fill="white"/>
                    <rect x="19.7432" y="29.4902" width="28.5714" height="7.14286" rx="3.57143" transform="rotate(45 19.7432 29.4902)" fill="white"/>
                    <rect x="19.7783" y="-0.779297" width="50" height="7.14286" rx="3.57143" transform="rotate(45 19.7783 -0.779297)" fill="white"/>
                </svg>
                <h1 class="my-4 text-white">
                    <span>{{ env('APP_NAME') }} - Design System</span>
                </h1>
                <h4 class="text-white mb-5">Production ready FREE Open Source <b>Dashboard UI Kit</b> and <b>Design System</b>.</h4>
                <div class="d-flex justify-content-center align-items-center">
                    <div>
                        <a class="bg-white btn btn-light d-flex" target="_blank" href="{{ route('dashboard') }}">
                            <svg width="22" height="22" class="me-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            Dashboard Demo
                        </a>
                    </div>
                    <div class="ms-3">
                        <a class="bg-white btn btn-light d-flex" target="_blank" href="https://github.com/iqonicdesignofficial/hope-ui-design-system">
                            <img src="{{ asset('/images/brands/23.png') }}" width="24px" height="24px" alt="GitHub">
                            <span class="mx-2 text-danger fw-bold">STAR US</span> <span>ON GITHUB</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Bar -->
    <div class="container">
        <nav class="nav navbar navbar-expand-lg navbar-light top-1 rounded">
            <div class="container-fluid">
                <a class="navbar-brand mx-2" href="#">
                    <svg width="30" class="text-primary" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"></rect>
                        <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"></rect>
                        <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"></rect>
                        <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"></rect>
                    </svg>
                    <h5 class="logo-title">{{ env('APP_NAME') }}</h5>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-2" aria-controls="navbar-2" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar-2">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-start">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="https://templates.iqonic.design/hope-ui/documentation/laravel/dist/main/" target="_blank">Documentation</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" aria-current="page" href="https://templates.iqonic.design/hope-ui/documentation/laravel/dist/main/change-log.html" target="_blank">Change Log</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-success" aria-current="page" href="https://iqonic.design/product/admin-templates/hope-ui-admin-free-open-source-bootstrap-admin-template/" target="_blank">
                                <svg width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v9.5l6 3.5V6a2 2 0 00-2-2h-4.5L12 3z"></path>
                                </svg>
                                Get It Now
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</x-app-layout>
