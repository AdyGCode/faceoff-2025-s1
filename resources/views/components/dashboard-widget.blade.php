@props(['title', 'count'])

<section class="md-4">
  <div class="rounded-t-md rounded-b-xl bg-[#939598] shadow-xl">
    <div class="mx-4 flex text-lg text-white py-4 font-extrabold"> 
      <div class="flex">
        <span>[{{ $count }}]</span>
        <h3>: {{ $title }}</h3>
      </div>
    </div>
    <div class="bg-[#D9D9D9] rounded-b-xl flex py-4 justify-center">
      {{ $slot }}
    </div>
  </div>
</section>