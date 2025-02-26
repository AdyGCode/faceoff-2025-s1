@props(['title', 'count'])

<section class="md-4">
  <div class="rounded-t-md rounded-b-xl border-2 border-[#939598]/10 shadow-sm">
    <div class="mx-4 flex text-lg py-4 font-extrabold"> 
      <div class="flex">
        <span>[{{ $count }}]</span>
        <h3>: {{ $title }}</h3>
      </div>
    </div>
    <div class="rounded-b-xl flex pb-4 justify-center">
      {{ $slot }}
    </div>
  </div>
</section>