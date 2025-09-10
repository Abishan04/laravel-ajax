@props([
    'type' => 'button',
    
])

<button type="{{ $type }}" {{ $attributes->merge(['class' => 'btn btn-primary w-100']) }}>
    {{ $slot }}
</button>