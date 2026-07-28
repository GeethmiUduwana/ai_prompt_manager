@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">Welcome back, {{ $user->name }}</h2>
        <p class="text-muted mb-0">Here's an overview of your AI Prompt Manager</p>
    </div>
    <a href="/prompts/create" class="btn btn-success">
        + New Prompt
    </a>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card p-4 border-0 shadow-sm" style="border-radius:14px;">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width:50px;height:50px;background:#ecfdf5;color:#10b981;font-size:1.5rem;">
                    &#128221;
                </div>
                <div>
                    <h3 class="mb-0 fw-bold">{{ $totalPrompts }}</h3>
                    <small class="text-muted">Total Prompts</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card p-4 border-0 shadow-sm" style="border-radius:14px;">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width:50px;height:50px;background:#eff6ff;color:#3b82f6;font-size:1.5rem;">
                    &#128193;
                </div>
                <div>
                    <h3 class="mb-0 fw-bold">{{ $totalCategories }}</h3>
                    <small class="text-muted">Categories</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card p-4 border-0 shadow-sm" style="border-radius:14px;">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width:50px;height:50px;background:#fce7f3;color:#ec4899;font-size:1.5rem;">
                    &#10084;&#65039;
                </div>
                <div>
                    <h3 class="mb-0 fw-bold">{{ $totalFavorites }}</h3>
                    <small class="text-muted">Favorites</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card p-4 border-0 shadow-sm" style="border-radius:14px;">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width:50px;height:50px;background:#fef3c7;color:#f59e0b;font-size:1.5rem;">
                    &#128100;
                </div>
                <div>
                    <h3 class="mb-0 fw-bold">{{ $user->name }}</h3>
                    <small class="text-muted">Account</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">

    <!-- Recent Prompts -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius:14px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Recent Prompts</h5>
                    <a href="/prompts" class="text-decoration-none" style="color:#11998e;font-weight:600;font-size:0.9rem;">View All &rarr;</a>
                </div>

                @if($recentPrompts->count() > 0)
                    @foreach($recentPrompts as $prompt)
                        <div class="d-flex justify-content-between align-items-start p-3 mb-2" style="background:#f8faf9;border-radius:10px;">
                            <div class="flex-grow-1">
                                <h6 class="mb-1 fw-bold">{{ $prompt->title }}</h6>
                                <p class="mb-1 text-muted" style="font-size:0.85rem;">
                                    {{ Str::limit($prompt->prompt, 80) }}
                                </p>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-primary" style="font-size:0.7rem;">{{ $prompt->category->name ?? 'Uncategorized' }}</span>
                                    <small class="text-muted">{{ $prompt->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            <div class="ms-3">
                                <button class="btn btn-sm btn-outline-secondary" onclick="copyDashboardPrompt('{{ addslashes($prompt->prompt) }}')" title="Copy Prompt">
                                    &#128203;
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-5">
                        <p class="text-muted mb-3">You haven't created any prompts yet.</p>
                        <a href="/prompts/create" class="btn btn-success">Create Your First Prompt</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">

        <!-- Quick Actions -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius:14px;">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">Quick Actions</h6>
                <a href="/prompts/create" class="d-flex align-items-center gap-3 p-3 mb-2 text-decoration-none" style="background:#ecfdf5;border-radius:10px;color:#065f46;">
                    <span style="font-size:1.3rem;">&#10133;</span>
                    <span class="fw-semibold">New Prompt</span>
                </a>
                <a href="/prompts" class="d-flex align-items-center gap-3 p-3 mb-2 text-decoration-none" style="background:#eff6ff;border-radius:10px;color:#1e40af;">
                    <span style="font-size:1.3rem;">&#128221;</span>
                    <span class="fw-semibold">View All Prompts</span>
                </a>
                <a href="/categories" class="d-flex align-items-center gap-3 p-3 mb-2 text-decoration-none" style="background:#f3e8ff;border-radius:10px;color:#6b21a8;">
                    <span style="font-size:1.3rem;">&#128193;</span>
                    <span class="fw-semibold">Manage Categories</span>
                </a>
                <a href="/favorites" class="d-flex align-items-center gap-3 p-3 text-decoration-none" style="background:#fce7f3;border-radius:10px;color:#9d174d;">
                    <span style="font-size:1.3rem;">&#10084;&#65039;</span>
                    <span class="fw-semibold">View Favorites</span>
                </a>
            </div>
        </div>

        <!-- Prompts by Category -->
        <div class="card border-0 shadow-sm" style="border-radius:14px;">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">Prompts by Category</h6>
                @if($categoryCounts->count() > 0)
                    @foreach($categoryCounts as $cat)
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="fw-medium" style="font-size:0.9rem;">{{ $cat->name }}</span>
                            <span class="badge" style="background:#11998e;border-radius:20px;font-size:0.75rem;">{{ $cat->count }}</span>
                        </div>
                        <div class="progress mb-3" style="height:6px;border-radius:10px;">
                            <div class="progress-bar" role="progressbar" style="width:{{ ($cat->count / max($totalPrompts, 1)) * 100 }}%;background:linear-gradient(135deg,#11998e,#38ef7d);border-radius:10px;"></div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted" style="font-size:0.9rem;">No data yet. Start adding prompts!</p>
                @endif
            </div>
        </div>

    </div>

</div>

<script>
function copyDashboardPrompt(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Prompt copied to clipboard!');
    });
}
</script>

@endsection
