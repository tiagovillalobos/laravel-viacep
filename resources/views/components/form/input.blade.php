<div class="mb-3">
    @if($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" name="{{ $name }}" class="{{ $classes }}">
</div>

@if($hasMask())
    @once
        @push('js')
            <script src="{{ asset('js/inputmask.js') }}"></script>
        @endpush
    @endonce
@endif