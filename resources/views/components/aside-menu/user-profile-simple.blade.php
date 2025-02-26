@props(['profilePhoto', 'userName'])

{{-- Users Profile --}}
<div class="flex">
  {{-- Users Profile Photo --}}
  <img
    class="rounded-full"
    src={{ $profilePhoto }}
    alt=""
    width="70"
  >
</div>
<div class="flex flex-col justify-center pl-4">
  <span>{{ $userName }}'s<br>
    <div class="text-2xl font-[900]">DashBoard</div>
  </span>
</div>
