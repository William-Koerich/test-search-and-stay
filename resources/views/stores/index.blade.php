@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Stores</h1>
        <a href="{{ route('stores.create') }}" class="btn btn-primary">Add Store</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($stores as $store)
                <tr>
                    <td>{{ $store->id }}</td>
                    <td>{{ $store->name }}</td>
                    <td>{{ $store->address }}</td>
                    <td>{{ $store->active }}</td>
                    <td>
                        <a href="{{ route('stores.edit', $store) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('stores.destroy', $store) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
