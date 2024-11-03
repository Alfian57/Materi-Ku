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
                    <a href="{{ route('dashboard.students.create') }}" class="btn btn-primary mb-3">Add New</a>
                </div>

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Point</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->account->email }}</td>
                                <td>Level {{ $item->level }}</td>
                                <td>{{ $item->point }}</td>
                                <td>{{ $item->address }}</td>
                                <td>
                                    <a href="{{ route('dashboard.students.edit', $item->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('dashboard.students.destroy', $item->id) }}" method="POST"
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
