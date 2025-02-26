<x-app-layout profilePhoto="{{ Auth::user()->profile_photo }}" userName="{{ Auth::user()->name }}">
  <x-slot name="header">
    <h2 class="text-xl font-extrabold leading-tight text-white">
      "Welcome back, {{ Str::upper(Auth::user()->name) }}!
      Here's a quick overview of your students and classes today."
    </h2>
  </x-slot>

  {{-- Display widgets, each on a separate row --}}
  <div class="mt-4 flex flex-wrap gap-4 mr-4">
    @foreach (array_chunk($widgets, 2) as $row)
      <div class="flex w-full gap-4">
        @foreach ($row as $widget)
          <div class="w-1/2">
            <x-dashboard-widget :title="$widget['title']" :count="$widget['count']">
              <div class="w-[90%]">
                {{ $widget['content'] }}
              </div>
            </x-dashboard-widget>
          </div>
        @endforeach
      </div>
    @endforeach
  </div>
</x-app-layout>
