@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center border-b-2 border-indigo-400 px-1 pt-1 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700'
            : 'inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium leading-5 text-gray-500 hover:border-gray-300 hover:text-gray-700 focus:outline-none focus:border-gray-300 focus:text-gray-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
