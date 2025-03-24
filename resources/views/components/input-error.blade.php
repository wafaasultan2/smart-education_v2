@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'text-sm text-red-600 '.session('theme','light').':text-red-400']) }}>{{ $message }}</p>
@enderror
