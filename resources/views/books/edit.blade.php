@extends('layout')

@section('content')
    <h1>Edit Book</h1>
    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $book->name }}" required>
        </div>
        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="number" class="form-control" id="isbn" name="isbn" value="{{ $book->isbn }}" required>
        </div>
        <div class="mb-3">
            <label for="value" class="form-label">Price</label>
            <input type="text" class="form-control" id="value" name="value" value="{{ $book->value }}" required>
        </div>
        <label for="store_id" class="form-label me-2">Store</label>
        <div class="mb-3 d-flex align-items-end">
            <select class="form-control" name="store_id">
                <option value="">Selecione uma loja</option>
                @foreach($stores as $store)
                    <option value="{{ $store->id }}" {{ $book->store_id == $store->id ? 'selected' : '' }}>{{ $store->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
@endsection
