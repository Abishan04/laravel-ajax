@props([
    'type' => 'text',
    'name',
    'label' => '',
    'placeholder' => '',
])

<div class="mb-3">
    @if($label)
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @endif

    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        placeholder="{{ $placeholder }}" 
        {{ $attributes->merge(['class' => 'form-control']) }}
    >
</div>