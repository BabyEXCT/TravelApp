<x-app-layout layout="simple" :assets="$assets ?? []">
    <span class="uisheet screen-darken"></span>
    <div class="header" style="background: url({{asset('images/travel/umrah-background.jpg')}}); background-size: cover; background-repeat: no-repeat; height: 100vh;position: relative;">
        <div class="main-img">
            <div class="container text-center">
                <img src="{{asset('images/travel/kaaba-logo.png')}}" width="100" alt="Umrah Logo" />
                <h1 class="my-4 text-white">
                    <span>{{env('APP_NAME')}} - Your Journey to the Holy Land</span>
                </h1>
                <h4 class="text-white mb-5">Experience the sacred pilgrimage of Umrah with exclusive packages and personalized services.</h4>

                <div class="d-flex justify-content-center align-items-center">
                    <div>
                        <a class="bg-white btn btn-light d-flex" href="{{route('packages.index')}}">
                            <svg width="22" height="22" class="me-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            Explore Umrah Packages
                        </a>
                    </div>
                    <div class="ms-3">
                        <a class="bg-white btn btn-light d-flex" target="_blank" href="https://example-travel-agency.com">
                            <img src="{{asset('/images/brands/umrah.png')}}" width="24px" height="24px">
                            <span class="mx-2 fw-bold">Get in Touch</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">

        </div>
    </div>
</x-app-layout>
