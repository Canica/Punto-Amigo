<div class="form-group">
    @if ($error)
        <label class="error">{{ $error }}</label>
    @endif
    {{ $control }}
</div>