@extends('dashboard.layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h2>{{ $homework->title }}</h2>

                <hr>

                <!-- Menampilkan detail konten homework -->
                <div class="homework-content">
                    {!! $homework->content !!}
                </div>

                <hr>

                <!-- Form untuk upload jawaban -->
                <div class="upload-answer mt-4">
                    <h5>Submit Your Answer (PDF Format)</h5>

                    <!-- Informasi kepada user mengenai format PDF -->
                    <p class="text-muted">Please upload your answer in PDF format (max size: 2MB).</p>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('dashboard.student.course.submit', [$course->slug, $homework->slug]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="file" class="form-label">Upload PDF Answer</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file"
                                name="file" accept="application/pdf" required>
                            @error('file')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="review" class="form-label">Review</label>
                            <textarea class="form-control @error('review') is-invalid @enderror" id="review" name="review" rows="4"
                                required></textarea>
                            @error('review')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit Answer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
