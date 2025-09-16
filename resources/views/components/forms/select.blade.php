@props([
    'id' => null,
    'name' => null,
    'label' => null,
])
<div>
 @if($label)
     <label for="{{ $name }}" class="form-label">{{ $label }}</label>
@endif
<select name="{{ $name }}" id="{{ $name }}" {{ $attributes}}>
        {{ $slot }}
    </select>
</div>