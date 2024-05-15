@extends('layout')

@section('content')
    <h1>New Book</h1>
    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="number" class="form-control" id="isbn" name="isbn" required>
        </div>
        <div class="mb-3">
            <label for="value" class="form-label">Price</label>
            <input type="text" class="form-control" id="value" name="value" required>
        </div>
        <label for="store_id" class="form-label me-2">Store</label>
        <div class="mb-3 d-flex align-items-end">
            <select class="form-control" name="store_id">
                <option value="">Select Store</option>
                @foreach($stores->pluck('name', 'id') as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>


            <button type="submit" class="btn btn-primary">Cadastrar Livro</button>
    </form>
@endsection

