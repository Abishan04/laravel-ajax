@props([
    'type' => '',
    'name',
    'id' => '',
    'label' => '',
    'value' => null,
    'placeholder' => '',
])

<div class="mb-3">
    @if($type === 'checkbox'|| $type === 'radio')
    <input 
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        value="{{ $value ?? 1 }}"
        {{ $attributes->merge(['class' => 'form-check-input']) }}
    >
    <label for="{{ $id ?? $name }}" class="form-check-label ms-2">{{ $label }}</label>
@else
 @if($label)
        <label for="{{ $name }}" class="form-label ms-2">{{ $label }}</label>
    @endif
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        @if(isset($value)) value="{{ $value }}" @endif
        placeholder="{{ $placeholder }}" 
        {{ $attributes->merge(['class' => 'form-control']) }}
    >
   
@endif
</div>