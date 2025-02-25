@props(['disabled' => false])

<div>
  <input
    id="{{ $attributes->get('id') }}"
    name="{{ $attributes->get('name') }}"
    type="file"
    @disabled($disabled)
    {{ $attributes->merge(['class' => 'block w-full text-sm text-gray-700 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}
  />
</div>
