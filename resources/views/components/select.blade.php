@props(['options', 'value' => null])

<select {{ $attributes->merge(['class' => 'mt-1 block w-full p-2 border rounded']) }}>
    @foreach($options as $option)
        <option value="{{ $option->value }}"
            {{ (is_string($value) ? $value : $value?->value) == $option->value ? 'selected' : '' }}>
            {{ ucfirst($option->value) }}
        </option>
    @endforeach
</select>
