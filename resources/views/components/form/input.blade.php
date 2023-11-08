<div class="mb-3">
    
    @if($label)
        <label for="{{ $name }}">
            {{ $label }}
            @if($optional)
                <small class="text-muted">
                    (Opcional)
                </small>
            @endif
        </label>
    @endif

    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        class="{{ $classes }}" 
        {{ $dataAttributes }} 
        {{ $attributes->merge(['readonly' => $readonly]) }}
    >

</div>

@if($hasMask())
    @once
        @push('js')
            <script src="{{ asset('js/inputmask.js') }}"></script>
        @endpush
    @endonce
@endif