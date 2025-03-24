@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 '.session('theme','light').':border-gray-700 '.session('theme','light').':bg-gray-900 '.session('theme','light').':text-gray-300 focus:border-indigo-500 '.session('theme','light').':focus:border-indigo-600 focus:ring-indigo-500 '.session('theme','light').':focus:ring-indigo-600 rounded-md shadow-sm']) !!}>
