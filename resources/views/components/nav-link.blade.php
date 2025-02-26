@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-[#D8272D] font-[700] inline-flex items-center px-1 pt-1 border-b-2 border-[#D8272D] text-sm font-medium leading-5 text-[#D42329] focus:outline-none focus:border-[#D8272D] transition duration-150 ease-in-out'
            : 'text-[#D8272D] font-[700] inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-[#D42329] hover:border-[#D42329] focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
