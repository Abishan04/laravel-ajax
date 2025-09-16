<div>
@if ($label)
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
@endif
<img src="{{ $value ?? '' }}" alt="{{  }}" class="img-fluid">
    
@endif
</div>