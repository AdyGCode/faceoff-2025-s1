<x-app-layout profilePhoto="{{ Auth::user()->profile_photo }}" userName="{{ Auth::user()->name }}">
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="text-xl font-semibold leading-tight text-white">
        {{ __('Face Off\'s Users') }}
      </h2>
      <a class="inline-flex items-center rounded bg-[#939598] px-4 py-2 text-white hover:bg-zinc-900 hover:text-white"
      href="{{ route('users.create') }}"
      >
      <i class="fa-solid fa-user-plus"></i>
      <span class="pl-4">Add User</span>
    </a>
  </div>
</x-slot>

@auth
<x-flash-message :data="session()" />
@endauth
<div>
  @foreach (array_chunk($users->all(), 2) as $userChunk)
      <div class="mr-4 mt-2 flex gap-4">
        @foreach ($userChunk as $user)
          <div class="w-1/2">
            <x-widgets.user-widget :user="$user">
            </x-widgets.user-widget>
          </div>
        @endforeach
      </div>
    @endforeach
  </div>

  {{-- Page navigation --}}
  <div class="bg-zinc-100 rounded-lg mt-4">
    <div class="px-6 py-2" colspan="5">
      @if ($users->hasPages())
          {{ $users->links() }}
      @elseif($users->total() === 0)
        <p class="py-2 text-sm text-zinc-800">No users found</p>
      @else
        <p class="py-2 text-sm text-zinc-800">All users shown</p>
      @endif
    </div>
  </div>
</x-app-layout>
