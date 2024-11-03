@extends('auth.layouts.main')

@section('content')
    <h1 class="auth-title">Log in.</h1>
    <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

    <form action="{{ route('dashboard.login.authenticate') }}" method="POST">
        @csrf

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="email" class="form-control form-control-xl @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" placeholder="Enter email...">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" class="form-control form-control-xl @error('password') is-invalid @enderror"
                name="password" placeholder="Enter password...">
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
    </form>
    <div class="text-center mt-5 text-lg fs-4">
        <p class="text-gray-600">Don't have an account? <a href="{{ route('dashboard.register.index') }}"
                class="font-bold">Sign
                up</a>.</p>
    </div>
    </div>
@endsection
