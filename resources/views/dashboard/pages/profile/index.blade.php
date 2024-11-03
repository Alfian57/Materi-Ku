@extends('dashboard.layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                {{-- Display Profile --}}
                <div class="profile-section">
                    <h5>Profile Details</h5>
                    <table class="table table-striped">
                        <tr>
                            <td>Name</td>
                            <td>{{ Auth::user()->accountable->name }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{ Auth::user()->accountable->address }}</td>
                        </tr>
                        @if (Auth::user()->accountable_type == 'App\\Models\\Student')
                            <tr>
                                <td>Level</td>
                                <td>Level {{ Auth::user()->accountable->level }}</td>
                            </tr>
                            <tr>
                                <td>Point</td>
                                <td>{{ Auth::user()->accountable->point }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td>Joined</td>
                            <td>{{ Auth::user()->created_at->format('d M Y') }}</td>
                        </tr>
                    </table>
                </div>

                {{-- Update Profile Form --}}
                <div class="update-profile-section mt-5">
                    <h5>Update Profile</h5>
                    <form action="{{ route('dashboard.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email', Auth::user()->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>

                {{-- Update Profile Pic Form --}}
                <div class="update-profile-section mt-5">
                    <h5>Update Profile</h5>
                    <form action="{{ route('dashboard.profile-pic.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control @error('profile_picture') is-invalid @enderror"
                                id="profile_picture" name="profile_picture" required>
                            @error('profile_picture')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update Profile Picture</button>
                    </form>
                </div>

                {{-- Update Password Form --}}
                <div class="update-password-section mt-5">
                    <h5>Update Password</h5>
                    <form action="{{ route('dashboard.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                id="current_password" name="current_password" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                id="new_password" name="new_password" required>
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="new_password_confirmation"
                                name="new_password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
