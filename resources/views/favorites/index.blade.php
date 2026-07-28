@extends('layouts.app')

@section('content')

<h2 class="page-title mb-4">
    My Favorite Prompts
</h2>

@if($favorites->count() > 0)
    @foreach($favorites as $favorite)

    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body p-4">

            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-2 gap-2">
                <h4 class="fw-bold mb-0">{{ $favorite->prompt->title }}</h4>
                <form action="/favorite/{{ $favorite->prompt_id }}" method="POST" class="d-inline flex-shrink-0">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-green-outline" onclick="return confirm('Remove from favorites?')">
                        Remove
                    </button>
                </form>
            </div>

            @if($favorite->prompt->category)
                <span class="badge badge-green mb-3">{{ $favorite->prompt->category->name }}</span>
            @endif

            <textarea 
            class="form-control mb-3"
            rows="4"
            readonly
            style="background:#f8faf9;border:1px solid #e8f5e9;border-radius:10px;resize:none;">{{ $favorite->prompt->prompt }}</textarea>

            <button 
            onclick="copyFavoritePrompt(this)"
            class="btn btn-green-outline px-4 py-2">
                Copy Prompt
            </button>

        </div>
    </div>

    @endforeach
@else
    <div class="card border-0 shadow-sm">
        <div class="card-body text-center py-5">
            <p class="text-muted mb-3">You haven't added any favorites yet.</p>
            <a href="/prompts" class="btn btn-green px-4 py-2">Browse Prompts</a>
        </div>
    </div>
@endif

<script>
function copyFavoritePrompt(btn) {
    let textarea = btn.closest('.card-body').querySelector('textarea');
    navigator.clipboard.writeText(textarea.value).then(function() {
        alert("Prompt copied to clipboard!");
    });
}
</script>

@endsection
