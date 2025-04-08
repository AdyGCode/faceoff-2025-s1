<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <div class="flex items-center">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
          {{ __('Face Off\'s Package Show') }}
        </h2>
      </div>
      <a class="inline-flex items-center rounded bg-zinc-200 px-4 py-2 text-zinc-800 hover:bg-zinc-900 hover:text-white"
        href="{{ route('packages.create') }}">

        <i class="fa-solid fa-square-plus"></i>
        <span class="pl-4">Add Package</span>
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
                <div class="grid grid-cols-1 text-surface min-w-full text-left text-sm font-light dark:text-white">

                  {{-- Header --}}
                  <div
                    class="grid grid-cols-6 border-b border-neutral-200 bg-zinc-800 font-medium text-white dark:border-white/10">
                    <p class="col-span-2 lg:col-span-1 border-b border-zinc-200 px-6 py-4 dark:border-white/10">Item</p>

                    <p class="col-span-3 border-b border-zinc-200 px-6 py-4 dark:border-white/10">Content</p>
                  </div>

                  <div class="grid grid-cols-6 border-b border-neutral-200 bg-white font-medium text-zinc-800 dark:border-white/10">

                    <div class="col-span-2 lg:col-span-1">
                      <p class="whitespace-nowrap border-b border-zinc-200 bg-zinc-300 px-6 py-4 dark:border-white/10">
                        ID
                      </p>

                      <p class="whitespace-nowrap border-b border-zinc-200 bg-zinc-300 px-6 py-4 dark:border-white/10">
                        National Code
                      </p>

                      <p class="whitespace-nowrap border-b border-zinc-200 bg-zinc-300 px-6 py-4 dark:border-white/10">
                        Title
                      </p>

                      <p class="whitespace-nowrap border-b border-zinc-200 bg-zinc-300 px-6 py-4 dark:border-white/10">
                        TGA Status
                      </p>

                      <p class="whitespace-nowrap border-b border-zinc-200 bg-zinc-300 px-6 py-4 dark:border-white/10">
                        Last update
                      </p>
                    </div>

                    <div class="col-span-3">
                      <p class="whitespace-nowrap border-b border-zinc-200 px-6 py-4 dark:border-white/10">
                        {{ $package->id }}
                      </p>

                      <p class="whitespace-nowrap border-b border-zinc-200 px-6 py-4 dark:border-white/10">
                        {{ $package->national_code }}
                      </p>

                      <p class="whitespace-nowrap border-b border-zinc-200 px-6 py-4 dark:border-white/10">
                        {{ $package->title}}
                      </p>

                      <p class="whitespace-nowrap border-b border-zinc-200 px-6 py-4 dark:border-white/10">
                        {{ $package->tga_status }}
                      </p>

                      <p class="whitespace-nowrap border-b border-zinc-200 px-6 py-4 dark:border-white/10">
                        {{ $package->updated_at }}
                      </p>

                    </div>
                  </div>

                  {{-- Header --}}
                  <div class="border-b border-neutral-200 bg-zinc-800 font-medium text-white dark:border-white/10">
                    <p class="border-b border-zinc-200 px-6 py-4 dark:border-white/10">Courses</p>
                  </div>

                  <div class="gid-cols-1 border-b border-neutral-200 bg-white px-6 py-4 font-medium text-zinc-800 dark:border-white/10">
                    @if ($courses->isNotEmpty())

                      <ul class="flex flex-wrap gap-4">
                        @foreach($courses as $course)
                        <li class="whitespace-nowrap border-b border-zinc-200 dark:border-white/10">
                          <a 
                            class="hover:underline hover:italic"
                            href="{{ route('courses.show', $course->id) }}"> 
                            {{ $course->title }}
                          </a>
                        </li>
                        @endforeach
                      </ul>

                      @else
                      <p class="whitespace-nowrap border-b border-zinc-200 dark:border-white/10">No Courses allocated to this Package.</p>
                    @endif
                  </div>

                  <footer
                    class="gid-cols-1 grid border-b border-neutral-200 px-6 py-4 font-medium text-zinc-800 dark:border-white/10">
                    <div class="flex gap-4">
                      <x-primary-button class="bg-zinc-800" type="button"
                        onclick="window.location.href='{{ route('packages.index', $package) }}'">
                        Return
                      </x-primary-button>
                      <form action="{{ route('packages.edit', $package) }}">
                        @csrf
                        <x-primary-button class="bg-zinc-800" href="">
                          Edit
                          <i class="fa-solid fa-edit order-first pr-2"></i>
                        </x-primary-button>
                      </form>
                      <form action="{{ route('packages.destroy', $package) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-secondary-button class="bg-zinc-200" type="submit"
                          onclick="return confirm('Are you sure you want to delete this user?')">
                          <span>Delete</span>
                          <i class="fa-solid fa-times order-first pr-2"></i>
                        </x-secondary-button>
                      </form>
                    </div>
                  </footer>
                </div>
              </section>

            </section>

          </article>

        </div>
      </div>
    </div>
  </div>
</x-app-layout>