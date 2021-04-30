<div class="invalid-feedback">
    @if (isset($errors) && $errors->has($field))
        {{ $errors->first($field) }}
    @elseif ($required)
        Campo obrigatório!
    @endif
</div>