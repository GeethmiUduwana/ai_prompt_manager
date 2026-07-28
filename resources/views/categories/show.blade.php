@extends('layouts.app')

@section('content')

<h2 class="page-title mb-4">
    {{ $category->name }}
</h2>

<div class="d-flex gap-2 mb-4">
    <a href="/categories/{{ $category->id }}/edit" class="btn btn-green px-4 py-2">
        Edit Category
    </a>
    <a href="/categories" class="btn btn-green-outline px-4 py-2">
        Back to Categories
    </a>
</div>

<h5 class="fw-bold mb-3">Prompts in this Category</h5>

@if($category->prompts->count() > 0)
    @foreach($category->prompts as $prompt)
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h4 class="fw-bold mb-0">{{ $prompt->title }}</h4>
                </div>

                @if($prompt->description)
                    <p class="text-muted mb-3">{{ $prompt->description }}</p>
                @endif

                <textarea 
                id="prompt{{$prompt->id}}"
                class="form-control mb-3"
                rows="4"
                readonly
                style="background:#f8faf9;border:1px solid #e8f5e9;border-radius:10px;resize:none;">{{ $prompt->prompt }}</textarea>

                <div class="d-flex gap-2 flex-wrap">
                    <button 
                    onclick="copyPrompt({{$prompt->id}})"
                    class="btn btn-green-outline px-4 py-2">
                        Copy Prompt
                    </button>
                    <a href="/prompts/{{ $prompt->id }}" class="btn btn-green px-4 py-2">
                        View Details
                    </a>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="card border-0 shadow-sm">
        <div class="card-body text-center py-5">
            <p class="text-muted mb-0">No prompts in this category yet.</p>
        </div>
    </div>
@endif

<script>
function copyPrompt(id) {
    let text = document.getElementById('prompt'+id).value;
    navigator.clipboard.writeText(text).then(function() {
        alert("Prompt copied to clipboard!");
    });
}
</script>

@endsection
