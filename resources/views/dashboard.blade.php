<x-app-layout profilePhoto="{{ Auth::user()->profile_photo }}" userName="{{ Auth::user()->name }}">
  <main>
    <x-slot name="header">
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ Str::upper(Auth::user()->name) }}'s
        {{ __('Dashboard') }}
      </h2>
    </x-slot>
  </main>
  </div>
</x-app-layout>
