@extends('layouts.app')

@section('content')

<h2 class="page-title mb-4">
    AI Prompts
</h2>

<form method="GET" action="/prompts">
    <div class="input-group mb-4">
        <input 
        type="text"
        name="search"
        class="form-control"
        placeholder="Search AI Prompt..."
        value="{{ request('search') }}"
        style="border-radius:10px 0 0 10px;padding:12px 16px;">

        <button class="btn btn-green" style="border-radius:0 10px 10px 0;padding:12px 24px;">
            Search
        </button>
    </div>
</form>

<a href="/prompts/create" class="btn btn-green mb-3 px-4 py-2">

    + Add New Prompt

</a>

@foreach($prompts as $prompt)

<div class="card mb-4 border-0 shadow-sm">
    <div class="card-body p-4">

        <div class="d-flex justify-content-between align-items-start mb-2">
            <h4 class="fw-bold mb-0">{{ $prompt->title }}</h4>
            <div class="d-flex gap-2 align-items-center">
                <span class="badge badge-green">{{ $prompt->category->name }}</span>
                <a href="/prompts/{{ $prompt->id }}" class="btn btn-sm btn-green-outline" title="View">
                    View
                </a>
                <a href="/prompts/{{ $prompt->id }}/edit" class="btn btn-sm btn-green-outline" title="Edit">
                    Edit
                </a>
                <form action="/prompts/{{ $prompt->id }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this prompt?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                        Delete
                    </button>
                </form>
            </div>
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

            <form 
            action="/favorite/{{$prompt->id}}" 
            method="POST"
            class="d-inline">
                @csrf
                <button class="btn btn-green px-4 py-2">
                    Add Favorite
                </button>
            </form>
        </div>

    </div>
</div>

@endforeach

<script>
function copyPrompt(id) {
    let text = document.getElementById('prompt'+id).value;
    navigator.clipboard.writeText(text).then(function() {
        alert("Prompt copied to clipboard!");
    });
}
</script>

@endsection
