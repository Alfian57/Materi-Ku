@extends('auth.layouts.main')

@section('content')
    <h1 class="auth-title">Register.</h1>

    <form action="{{ route('dashboard.register.store') }}" method="POST">
        @csrf

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" placeholder="Enter name...">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" placeholder="Enter email...">
            <div class="form-control-icon">
                <i class="bi bi-envelope"></i>
            </div>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" class="form-control form-control-lg @error('address') is-invalid @enderror" name="address"
                value="{{ old('address') }}" placeholder="Enter address...">
            <div class="form-control-icon">
                <i class="bi bi-house"></i>
            </div>
            @error('address')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                name="password" placeholder="Enter password...">
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror"
                name="password_confirmation" placeholder="Confirm password...">
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
            @error('password_confirmation')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
    </form>
    <div class="text-center mt-5 text-lg fs-4">
        <p class="text-gray-600">Have an account? <a href="{{ route('dashboard.login.index') }}" class="font-bold">Sign
                in</a>.</p>
    </div>
    </div>
@endsection
