@props(['user'])
<section class="md-4">
  <div class="rounded-b-xl rounded-t-md border-2 border-[#939598]/10 shadow-sm">
    <div class="rounded-t-md bg-[#D8272D] px-4 font-bold text-white">
      <div class="flex items-center justify-between">
        <span>
          Lecturer
        </span>
        <span class="text-sm">
          <a href="mailto:{{ $user->email }}">
            📧: {{ $user->email }}
          </a>
        </span>
      </div>
    </div>
    <form action="{{ route('users.show', $user) }}">
      <button class="mx-4 flex py-4 text-lg font-extrabold">
        <div class="flex">
          <div class="mr-4 rounded-full bg-[#D8272D] p-1">
            <img
              src="{{ asset($user->profile_photo) }}"
              alt="profile_photo"
              width="70"
              height="70"
            >
          </div>
          <div class="flex flex-col items-start">
            <div class="pl-4">
              Name: {{ $user->name }}
            </div>
            <div class="pl-4 text-sm">
              Full Name: {{ $user->given_name }} {{ $user->family_name }}
            </div>
          </div>
        </div>
      </button>
    </form>
    <div class="flex justify-center rounded-b-xl pb-4">
      <div class="flex w-[90%] justify-end gap-4">
        <form action="{{ route('users.edit', $user) }}" method="GET">
          @csrf
          <x-primary-button class="bg-[#939598]" href="{{ route('users.edit', $user) }}">
            <span>Edit </span>
            <i class="fa-solid fa-edit order-first pr-2"></i>
          </x-primary-button>
        </form>
        <form action="{{ route('users.destroy', $user) }}" method="POST">
          @csrf
          @method('DELETE')
          <x-secondary-button
            class="bg-zinc-200"
            type="submit"
            onclick="return confirm('Are you sure you want to delete this user?')"
          >
            <span>Delete</span>
            <i class="fa-solid fa-times order-first pr-2"></i>
          </x-secondary-button>
        </form>
      </div>
    </div>
  </div>
</section>
