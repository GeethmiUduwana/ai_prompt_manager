@extends('layouts.app')

@section('content')

<h2 class="page-title mb-4">
    {{ $prompt->title }}
</h2>

<div class="d-flex gap-2 mb-4">
    <a href="/prompts/{{ $prompt->id }}/edit" class="btn btn-green px-4 py-2">
        Edit Prompt
    </a>
    <a href="/prompts" class="btn btn-green-outline px-4 py-2">
        Back to Prompts
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h4 class="fw-bold mb-1">{{ $prompt->title }}</h4>
                <span class="badge badge-green">{{ $prompt->category->name ?? 'Uncategorized' }}</span>
            </div>
            <small class="text-muted">{{ $prompt->created_at->diffForHumans() }}</small>
        </div>

        @if($prompt->description)
            <p class="text-muted mb-3">{{ $prompt->description }}</p>
        @endif

        <label class="form-label fw-semibold">AI Prompt</label>
        <textarea 
        id="prompt-detail"
        class="form-control mb-3"
        rows="6"
        readonly
        style="background:#f8faf9;border:1px solid #e8f5e9;border-radius:10px;resize:none;">{{ $prompt->prompt }}</textarea>

        <div class="d-flex gap-2 flex-wrap">
            <button 
            onclick="copyPrompt()"
            class="btn btn-green px-4 py-2">
                Copy Prompt
            </button>
            <form 
            action="/favorite/{{ $prompt->id }}" 
            method="POST"
            class="d-inline">
                @csrf
                <button class="btn btn-green-outline px-4 py-2">
                    Add Favorite
                </button>
            </form>
        </div>

    </div>
</div>

<script>
function copyPrompt() {
    let text = document.getElementById('prompt-detail').value;
    navigator.clipboard.writeText(text).then(function() {
        alert("Prompt copied to clipboard!");
    });
}
</script>

@endsection
