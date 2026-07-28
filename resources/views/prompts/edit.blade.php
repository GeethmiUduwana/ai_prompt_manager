@extends('layouts.app')

@section('content')

<h2 class="page-title mb-4">
    Edit Prompt
</h2>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <form action="/prompts/{{ $prompt->id }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Title</label>
                <input 
                type="text" 
                name="title" 
                class="form-control" 
                value="{{ $prompt->title }}"
                placeholder="Enter prompt title" 
                required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Category</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $prompt->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">AI Prompt</label>
                <textarea 
                name="prompt" 
                class="form-control" 
                rows="6" 
                placeholder="Write your prompt here..." 
                required>{{ $prompt->prompt }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Description</label>
                <textarea 
                name="description" 
                class="form-control" 
                rows="3" 
                placeholder="Brief description (optional)">{{ $prompt->description }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-green px-4 py-2">
                    Update Prompt
                </button>
                <a href="/prompts" class="btn btn-green-outline px-4 py-2">
                    Cancel
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
