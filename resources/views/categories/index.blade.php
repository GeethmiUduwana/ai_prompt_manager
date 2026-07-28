@extends('layouts.app')

@section('content')

<h2 class="page-title mb-4">
    Categories
</h2>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">

        <form action="/categories" method="POST" class="d-flex flex-column flex-sm-row gap-2 align-items-stretch align-items-sm-end">

            @csrf

            <div class="flex-grow-1">
                <label class="form-label fw-semibold">New Category</label>
                <input 
                type="text"
                name="name"
                class="form-control"
                placeholder="Enter category name"
                required>
            </div>

            <button type="submit" class="btn btn-green px-4 py-2" style="white-space:nowrap;">
                + Add Category
            </button>

        </form>

    </div>
</div>

<h5 class="fw-bold mb-3">All Categories</h5>

@if($categories->count() > 0)
    <div class="row g-3">
        @foreach($categories as $category)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="rounded-3 d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#ecfdf5;color:#10b981;font-size:1.1rem;">
                                &#128193;
                            </div>
                            <div class="flex-grow-1">
                                <span class="fw-semibold">{{ $category->name }}</span>
                                <br>
                                <span class="badge badge-green">{{ $category->prompts_count ?? $category->prompts->count() }} prompts</span>
                            </div>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            <a href="/categories/{{ $category->id }}" class="btn btn-sm btn-green-outline flex-fill">View</a>
                            <a href="/categories/{{ $category->id }}/edit" class="btn btn-sm btn-green-outline flex-fill">Edit</a>
                            <form action="/categories/{{ $category->id }}" method="POST" class="d-inline flex-fill" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger w-100">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="card border-0 shadow-sm">
        <div class="card-body text-center py-5">
            <p class="text-muted mb-0">No categories yet. Create your first one above!</p>
        </div>
    </div>
@endif

@endsection
