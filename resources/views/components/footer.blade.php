@props(['bgColor', 'height'])

<footer>
  <div {{ $attributes->merge(['class', '$bgColor $height'])}}>
{{ $slot }}
  </div>
</footer>