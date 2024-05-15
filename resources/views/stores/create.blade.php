@extends('layout')

@section('content')
    <h1>New Store</h1>
    <form action="{{ route('stores.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" id="active" name="active">
            <label class="form-check-label" for="active">Active</label>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
@endsection
