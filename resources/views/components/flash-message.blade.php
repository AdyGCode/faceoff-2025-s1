@props(['message', 'icon', 'type', 'fgColour', 'bgColour', 'fgText', 'bgText'])

<div
  x-data="{ show: true }"
  x-init="setTimeout(() => show = false, 5000)"
  x-show="show"
  x-transition:fade.duration.1000ms
  :class="{
      '{{ $bgText }}': true,
      '-mx-2': true,
      'flex': true,
      'items-center': true,
      'overflow-hidden': true
  }"
>
  <section class="{{ $bgColour }} p-6 py-2 text-center">
    <i class="{{ $icon }} {{ $fgColour }} min-w-24 text-5xl"></i>
  </section>

  <div class="{{ $fgText }} px-6">
    <h3 class="tracking-wider">{{ $type }}</h3>
    <p class="text-xl">{{ $message }}</p>
  </div>
</div>
