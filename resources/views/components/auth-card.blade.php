<div class="min-h-screen flex flex-col justify-center items-center px-4 py-12">
    <div class="mb-8">
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md px-8 py-10 bg-white/95 backdrop-blur-sm shadow-2xl rounded-2xl">
        {{ $slot }}
    </div>

    <p class="mt-8 text-sm text-white/70">
        {{ config('app.name', 'AI Prompt Manager') }}
    </p>
</div>
