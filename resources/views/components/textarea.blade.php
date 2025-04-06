@props(['value' => ''])

<textarea {{ $attributes->merge(['class' => 'mt-1 block w-full p-2 border rounded']) }}>{{ $value }}</textarea>
