@extends('layouts.app')

@section('content')

<h2 class="page-title mb-4">
    Edit Category
</h2>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <form action="/categories/{{ $category->id }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Category Name</label>
                <input 
                type="text" 
                name="name" 
                class="form-control" 
                value="{{ $category->name }}"
                placeholder="Enter category name" 
                required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-green px-4 py-2">
                    Update Category
                </button>
                <a href="/categories" class="btn btn-green-outline px-4 py-2">
                    Cancel
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
