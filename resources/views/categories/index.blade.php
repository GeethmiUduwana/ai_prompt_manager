@extends('layouts.app')

@section('content')

<h2 class="page-title mb-4">
    Categories
</h2>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">

        <form action="/categories" method="POST" class="d-flex gap-2 align-items-end">

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
                    <div class="card-body d-flex align-items-center justify-content-between p-3">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-3 d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#ecfdf5;color:#10b981;font-size:1.1rem;">
                                &#128193;
                            </div>
                            <span class="fw-semibold">{{ $category->name }}</span>
                        </div>
                        <span class="badge badge-green">{{ $category->prompts_count ?? $category->prompts->count() }} prompts</span>
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
