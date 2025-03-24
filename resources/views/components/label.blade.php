@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 '.session('theme','light').':text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>
