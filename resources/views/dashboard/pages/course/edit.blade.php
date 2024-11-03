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
                <h4>Edit Course</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.courses.update', $course->slug) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" value="{{ old('title', $course->title) }}" placeholder="Enter course title...">
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($course->thumbnail)
                        <div class="form-group mt-3">
                            <label>Current Thumbnail</label>
                            <div>
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Current Thumbnail"
                                    class="img-thumbnail" style="max-height: 200px;">
                            </div>
                        </div>
                    @endif

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
                            @foreach ($courseCategories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('course_category_id', $course->course_category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_category_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="teacher_id">Teacher</label>
                        <select class="form-control @error('teacher_id') is-invalid @enderror" id="teacher_id"
                            name="teacher_id">
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}"
                                    {{ old('teacher_id', $course->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('teacher_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            placeholder="Enter course description..." rows="10">{{ old('description', $course->description) }}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content"
                            placeholder="Enter course content..." rows="20">{{ old('content', $course->content) }}</textarea>
                        @error('content')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <p class="text-danger">*If you don't want to change the thumbnail, leave the thumbnail field empty.</p>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </section>
@endsection
