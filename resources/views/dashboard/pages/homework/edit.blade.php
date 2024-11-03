@extends('dashboard.layouts.main')

@push('styles')
    <link rel="stylesheet" href="/assets/extensions/summernote/summernote-lite.css">
    <link rel="stylesheet" href="/assets/compiled/css/form-editor-summernote.css">
@endpush

@push('scripts')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="/assets/extensions/summernote/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#content').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['view', ['codeview']],
                ]
            });
        });
    </script>
@endpush

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Edit Homework</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.homeworks.update', [$course->slug, $homework->slug]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control @error('title')  is-invalid @enderror" id="title"
                            name="title" value="{{ old('title', $homework->title) }}"
                            placeholder="Enter category title...">
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control @error('content')  is-invalid @enderror" id="content" name="content"
                            placeholder="Enter category content...">{{ old('content', $homework->content) }}</textarea>
                        @error('content')
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
