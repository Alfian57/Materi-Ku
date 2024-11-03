@extends('dashboard.layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Give Grade</h4>
            </div>
            <div class="card-body">

                <a href="{{ asset('storage/' . $assignment->file) }}" target="_blank"
                    class="btn btn-sm btn-secondary mb-3">Open
                    Assignment</a>

                <form action="{{ route('dashboard.assignments.update', [$course->slug, $homework->slug, $assignment->id]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="point">Point</label>
                        <input type="text" class="form-control @error('point')  is-invalid @enderror" id="point"
                            name="point" value="{{ old('point') }}" placeholder="Enter point...">
                        @error('point')
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
