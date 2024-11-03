@extends('dashboard.layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Create Course Category</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.course-categories.update', $courseCategory->slug) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name')  is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $courseCategory->name) }}"
                            placeholder="Enter category name...">
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </section>
@endsection
