@extends('layout')

@section('content')
    <div class="container">
        <h1>Edit Store</h1>
        <form action="{{ route('stores.update', $store->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Usado para especificar o método HTTP PUT para o formulário --}}

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required value="{{ $store->name }}">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" required value="{{ $store->address }}">
            </div>
            <div class="mb-3 form-check form-switch">
                <input class="form-check-input" type="checkbox" id="active" name="active" {{ $store->active ? 'checked' : '' }}>
                <label class="form-check-label" for="active">Active</label>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
