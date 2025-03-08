@props(['name', 'options', 'checked' => false])

@foreach ($options as $value => $text)
    <div class="form-check">
        <input {{ $attributes->class(['form-check-input', 'is-invalid' => $errors->has($name)]) }} type="radio"
            name="{{ $name }}" value="{{ $value }}" @checked(old($name, $checked) == $value)>
        <label class="form-check-label">{{ $text }}</label>
    </div>
@endforeach
