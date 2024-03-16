@if ($errors->has($field))
    <span style="display: block;" class="invalid-feedback" role="alert">{{ $errors->first($field) }}</span>
@endif
