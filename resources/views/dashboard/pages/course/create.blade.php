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
                <h4>Create Course</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.courses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" value="{{ old('title') }}" placeholder="Enter course title...">
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="thumbnail">Thumbnail</label>
                        <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail"
                            name="thumbnail">
                        @error('thumbnail')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="course_category_id">Course Category</label>
                        <select class="form-control @error('course_category_id') is-invalid @enderror"
                            id="course_category_id" name="course_category_id">
                            <option value="">Select category</option>
                            @foreach ($courseCategories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('course_category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_category_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            placeholder="Enter course description..." rows="10">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
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
