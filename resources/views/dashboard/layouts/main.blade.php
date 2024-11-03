@include('dashboard.components.header')

<body>
    @include('sweetalert::alert')
    {{-- <script src="/assets/static/js/initTheme.js"></script> --}}

    <div id="app">
        @include('dashboard.components.sidebar')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading d-flex justify-content-between align-items-center">
                <h3>{{ $title }}</h3>
                <div class="dropdown">
                    <a class="avatar avatar-lg" href="#" role="button" id="dropdownMenuLink"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        @if (Auth::user()->profile_picture)
                            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="student">
                        @else
                            <img src="/assets/compiled/jpg/1.jpg" alt="Profile Picture">
                        @endif
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('dashboard.profile.index') }}">Profile</a></li>
                        <li>
                            <form action="{{ route('dashboard.logout') }}" method="POST" class="ms-4">
                                @csrf
                                <button type="submit" class="dropdown-item"
                                    style="background: none; border: none; padding: 0; cursor: pointer;">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="page-content">
                <section class="row">
                    @yield('content')
                </section>
            </div>

            @include('dashboard.components.footer')
        </div>
    </div>

    @include('dashboard.components.scripts')

</body>

</html>
