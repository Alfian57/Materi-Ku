@extends('dashboard.layouts.main')

@push('scripts')
    <script src="/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="/assets/static/js/pages/simple-datatables.js"></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="/assets/extensions/simple-datatables/style.css">
@endpush

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="text-end">
                    <a href="{{ route('dashboard.courses.create') }}" class="btn btn-primary mb-3">Add New</a>
                </div>

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Thumnbail</th>
                            <th>Category</th>
                            <th class="w-25">Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>
                                    <a href="{{ asset('storage/' . $item->thumbnail) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="Thumnail"
                                            style="width: 100px">
                                    </a>
                                </td>
                                <td>{{ $item->courseCategory->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <a href="{{ route('dashboard.courses.show', $item->slug) }}"
                                        class="btn btn-sm btn-primary">Detail</a>
                                    <a href="{{ route('dashboard.homeworks.index', $item->slug) }}"
                                        class="btn btn-sm btn-info">Homework</a>
                                    <a href="{{ route('dashboard.courses.edit', $item->slug) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('dashboard.courses.destroy', $item->slug) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure want to delete the data ?')"
                                            class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection
