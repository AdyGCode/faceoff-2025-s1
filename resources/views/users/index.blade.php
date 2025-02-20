<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Face Off\'s User DB') }}
      </h2>
      <x-primary-button
        class="bg-zinc-200 text-zinc-800 hover:bg-zinc-900 hover:text-white"
        type="a"
        href="{{ route('users.create') }}"
      >
        <i class="fa-solid fa-user-plus"></i>
        <span class="pl-4">Add User</span>
      </x-primary-button>
    </div>
  </x-slot>

  <div class="py-2">
    <div class="mx-auto max-w-7xl sm:px-2 lg:px-4">
      <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="text-gray-900">
          <article class="-mx-4">
            <section class="mt-4 grid grid-cols-1 gap-4 px-4 sm:px-8">

              <section class="min-w-full items-center overflow-hidden rounded border border-zinc-600 bg-zinc-50">

                <table class="text-surface min-w-full text-left text-sm font-light dark:text-white">
                  <thead class="border-b border-neutral-200 bg-zinc-800 font-medium text-white dark:border-white/10">
                    <tr>
                      <th
                        class="px-6 py-4"
                        width="10%"
                        scope="col"
                      >#</th>
                      <th
                        class="px-6 py-4"
                        width="10%"
                        scope="col"
                      >Avatar</th>
                      <th
                        class="px-6 py-4"
                        width="40%"
                        scope="col"
                      >Name (E-mail)</th>
                      <th
                        class="px-6 py-4"
                        width="40%"
                        scope="col"
                      >Actions</th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach ($users as $user)
                      <tr class="border-b border-zinc-300 text-black dark:border-white/10">
                        <td class="whitespace-nowrap px-6 py-4 font-medium">
                          {{ $loop->index + 1 + ($users->currentPage() - 1) * $users->perPage() }}</td>
                        <td class="whitespace-nowrap px-6 py-4"><img
                            class="rounded-full"
                            src="{{ $user->profile_photo }}"
                            alt="profile photo"
                            width="50"
                          >
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">🔖 {{ $user->name }}<br>📧: {{ $user->email }}</td>
                        <td class="whitespace-nowrap px-6 py-4">
                          <div class="flex gap-4">
                            <form action="{{ route('users.show', $user) }}">
                              <x-primary-button class="bg-zinc-800" href="{{ route('users.show', $user) }}">
                                <span>Show </span>
                                <i class="fa-solid fa-eye order-first pr-2"></i>
                              </x-primary-button>
                            </form>
                            <form action="{{ route('users.edit', $user) }}" method="GET">
                              @csrf
                              <x-primary-button class="bg-zinc-800" href="{{ route('users.edit', $user) }}">
                                <span>Edit </span>
                                <i class="fa-solid afa-edit order-first pr-2"></i>
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
                        </td>
                      </tr>
                    @endforeach
                  </tbody>

                  <tfoot>
                    <tr class="bg-zinc-100">
                      <td class="px-6 py-2" colspan="5">
                        @if ($users->hasPages())
                          {{ $users->links() }}
                        @elseif($users->total() === 0)
                          <p class="py-2 text-sm text-zinc-800">No users found</p>
                        @else
                          <p class="py-2 text-sm text-zinc-800">All users shown</p>
                        @endif
                      </td>
                    </tr>
                  </tfoot>

                </table>

              </section>

            </section>

        </div>

        </article>

      </div>
    </div>
  </div>
  </div>
</x-app-layout>
