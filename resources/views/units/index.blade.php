<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Face Off\'s Units ') }}
      </h2>
      <a class="inline-flex items-center rounded bg-zinc-200 px-4 py-2 text-zinc-800 hover:bg-zinc-900 hover:text-white"
        href="{{ route('units.create') }}">
        
        <i class="fa-solid fa-square-plus"></i>
        <span class="pl-4">Add Unit</span>
      </a>
    </div>
  </x-slot>

  @auth
    <x-flash-message :data="session()" />
  @endauth

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
                      <th class="px-6 py-4" width="10%" scope="col">#</th>
                      <th class="px-6 py-4" width="20%" scope="col">National Code</th>
                      <th class="px-6 py-4" width="40%" scope="col">Title</th>
                      <th class="px-6 py-4" width="20%" scope="col">TGA Status</th>
                      <th class="px-6 py-4" width="20%" scope="col">Status Code</th>
                      <th class="px-6 py-4" width="20%" scope="col">Nominal Hours</th>
                      <th class="px-6 py-4" width="20%" scope="col">Actions</th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach ($units as $unit)
                      <tr class="border-b border-zinc-300 text-black dark:border-white/10">

                        <td class="px-6 py-4 font-medium">
                          {{ $loop->index + 1 + ($units->currentPage() - 1) * $units->perPage() }}
                        </td>

                        <td class="px-6 py-4">
                          {{ $unit->national_code }}
                        </td>

                        <td class="px-6 py-4">
                          {{ $unit->title }}
                        </td>

                        <td class="px-6 py-4">
                          {{ $unit->tga_status }}
                        </td>

                        <td class="px-6 py-4">
                          {{ $unit->status_code }}
                        </td>

                        <td class="px-6 py-4">
                          {{ $unit->nominal_hours }}
                        </td>

                        <td class="px-6 py-4">
                          <div class="flex gap-4">

                            <form action="{{ route('units.show', $unit) }}">
                              <x-primary-button class="bg-zinc-800" href="{{ route('units.show', $unit) }}">
                                <span>Show </span>
                                <i class="fa-solid fa-eye order-first pr-2"></i>
                              </x-primary-button>
                            </form>

                            <form action="{{ route('units.edit', $unit) }}" method="GET">
                              @csrf
                              <x-primary-button class="bg-zinc-800" href="{{ route('units.edit', $unit) }}">
                                <span>Edit </span>
                                <i class="fa-solid fa-edit order-first pr-2"></i>
                              </x-primary-button>
                            </form>

                            <form action="{{ route('units.destroy', $unit) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <x-secondary-button class="bg-zinc-200" type="submit"
                                onclick="return confirm('Are you sure you want to delete this unit?')">
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
                        @if ($units->hasPages())
                            {{ $units->links('pagination::tailwind') }}
                        @elseif($units->total() === 0)
                          <p class="py-2 text-sm text-zinc-800">No units found</p>
                        @else
                          <p class="py-2 text-sm text-zinc-800">All units shown</p>
                        @endif
                      </td>
                    </tr>
                  </tfoot>

                </table>
              </section>
            </section>
          </article>
        </div>
      </div>
    </div>
  </div>

</x-app-layout>