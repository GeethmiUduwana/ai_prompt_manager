@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'p-4 bg-green-50 border border-green-200 rounded-xl text-sm text-green-700']) }}>
        {{ $status }}
    </div>
@endif
