<ul class="navbar-nav iq-main-menu"  id="sidebar">
    <li class="nav-item static-item">
        <a class="nav-link static-item disabled" href="#" tabindex="-1">
            <span class="default-icon">Home</span>
            <span class="mini-icon">-</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{activeRoute(route('dashboard'))}}" aria-current="page" href="{{route('dashboard')}}">
            <i class="icon">
                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.4" d="M16.0756 2H19.4616C20.8639 2 22.0001 3.14585 22.0001 4.55996V7.97452C22.0001 9.38864 20.8639 10.5345 19.4616 10.5345H16.0756C14.6734 10.5345 13.5371 9.38864 13.5371 7.97452V4.55996C13.5371 3.14585 14.6734 2 16.0756 2Z" fill="currentColor"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z" fill="currentColor"></path>
                </svg>
            </i>
            <span class="item-name">Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{activeRoute(route('user.packages.index'))}}" aria-current="page" href="{{route('user.packages.index')}}">
            <i class="icon">
                <!-- Replace with an appropriate package icon -->
                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.4" d="M3 3h18v18H3V3z" fill="currentColor"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5 7h14v2H5V7zm0 4h10v2H5v-2zm0 4h8v2H5v-2z" fill="currentColor"></path>
                </svg>
            </i>
            <span class="item-name">Packages</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ activeRoute(route('user.invoices.index')) }}" aria-current="page" href="{{ route('user.invoices.index') }}">
            <i class="icon">
                <!-- Replace with an appropriate invoice icon -->
                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.4" d="M20 2H8C6.9 2 6 2.9 6 4V20C6 21.1 6.9 22 8 22H20C21.1 22 22 21.1 22 20V4C22 2.9 21.1 2 20 2ZM20 20H8V4H20V20ZM8 4V6H20V4H8Z" fill="currentColor"></path>
                    <path d="M8 10H20V12H8V10ZM8 14H20V16H8V14ZM8 18H20V20H8V18Z" fill="currentColor"></path>
                </svg>
            </i>
            <span class="item-name">Invoices</span>
        </a>
    </li>



</ul>
