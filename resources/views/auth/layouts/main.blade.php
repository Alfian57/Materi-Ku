@include('auth.components.head')

<body>
    @include('sweetalert::alert')
    {{-- <script src="/assets/static/js/initTheme.js"></script> --}}
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="#"><img src="/assets/static/logo/logo-text-transparent.png" alt="Logo"></a>
                    </div>

                    @yield('content')

                </div>
                <div class="col-lg-7 d-none d-lg-block">
                    <div id="auth-right">
                        <img src="/assets/static/images/bg/auth.jpg" alt="" class="img-fit"
                            style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>

        </div>
</body>

</html>
