<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <div class="flex items-center">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
          {{ __('Face Off\'s Course Show') }}
        </h2>
      </div>
      <a class="inline-flex items-center rounded bg-zinc-200 px-4 py-2 text-zinc-800 hover:bg-zinc-900 hover:text-white"
        href="{{ route('courses.create') }}">

        <i class="fa-solid fa-square-plus"></i>
        <span class="pl-4">Add Course</span>
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
                    <p class="col-span-1 border-b border-zinc-200 px-6 py-4 dark:border-white/10">Item</p>

                    <p class="col-span-3 border-b border-zinc-200 px-6 py-4 dark:border-white/10">Content</p>
                  </div>

                  <div class="grid grid-cols-6 border-b border-neutral-200 bg-white font-medium text-zinc-800 dark:border-white/10">

                    <div class="col-span-1">
                      <p class=" border-b border-zinc-200 bg-zinc-300 px-6 py-4 dark:border-white/10">
                        ID
                      </p>

                      <p class=" border-b border-zinc-200 bg-zinc-300 px-6 py-4 dark:border-white/10">
                        National Code
                      </p>

                      <p class=" border-b border-zinc-200 bg-zinc-300 px-6 py-4 dark:border-white/10">
                        Title
                      </p>

                      <p class=" border-b border-zinc-200 bg-zinc-300 px-6 py-4 dark:border-white/10">
                        TGA Status
                      </p>

                      <p class=" border-b border-zinc-200 bg-zinc-300 px-6 py-4 dark:border-white/10">
                        Last update
                      </p>
                    </div>

                    <div class="col-span-3">
                      <p class=" border-b border-zinc-200 px-6 py-4 dark:border-white/10">
                        {{ $course->id }}
                      </p>

                      <p class=" border-b border-zinc-200 px-6 py-4 dark:border-white/10">
                        {{ $course->national_code }}
                      </p>

                      <p class=" border-b border-zinc-200 px-6 py-4 dark:border-white/10">
                        {{ $course->title}}
                      </p>

                      <p class=" border-b border-zinc-200 px-6 py-4 dark:border-white/10">
                        {{ $course->tga_status }}
                      </p>

                      <p class=" border-b border-zinc-200 px-6 py-4 dark:border-white/10">
                        {{ $course->updated_at }}
                      </p>

                    </div>
                  </div>

                  {{-- Header --}}
                  <div class="grid grid-cols-6 border-b border-neutral-200 bg-zinc-800 font-medium text-white dark:border-white/10">
                    <p class="col-span-2 border-b border-zinc-200 px-6 py-4 dark:border-white/10">Package</p>
                    <p class="col-span-2 border-b border-zinc-200 px-6 py-4 dark:border-white/10">Clusters</p>
                    <p class="col-span-2 border-b border-zinc-200 px-6 py-4 dark:border-white/10">Units</p>
                  </div>

                  <div class="grid grid-cols-6 gap-4 border-b border-neutral-200 bg-white px-6 py-4 font-medium text-zinc-800 dark:border-white/10">
                    
                    {{-- Packages --}}
                    <div class="col-span-2">
                      @if ($course->package)

                        <ul class="flex flex-wrap gap-2">
                          <li class=" border-b border-zinc-200 dark:border-white/10">
                            <a 
                              class="hover:underline hover:italic"
                              href="{{ route('packages.show', $course->package->id) }}"> 

                              {{ $course->package->title }} 
                            </a>
                          </li>
                        </ul>

                        @else
                        <p class=" border-b border-zinc-200 dark:border-white/10">No Package allocated to this course.</p>
                      @endif
                    </div>

                    {{-- Clusters --}}
                    <div class="col-span-2">
                      @if ($course->clusters->isNotEmpty())

                        <ul class="flex flex-wrap gap-2">
                          @foreach($course->clusters as $cluster)
                          <li class="border-b border-zinc-200 dark:border-white/10">
                            <a 
                              class="hover:underline hover:italic"
                              href="{{ route('clusters.show', $cluster->id) }}">
                              {{ $cluster->title }} 
                            </a>
                          </li>
                          @endforeach
                        </ul>

                        @else
                        <p class=" border-b border-zinc-200 dark:border-white/10">No Cluster allocated to this course.</p>
                      @endif
                    </div>

                    {{-- Units --}}
                    <div class="col-span-2">
                      @if ($course->units->isNotEmpty())

                        <ul class="flex flex-wrap flex-col gap-2">
                          @foreach($course->units as $unit)
                          <li class="border-b border-zinc-200 dark:border-white/10">
                            <a 
                              class="hover:underline hover:italic"
                              href="{{ route('units.show', $unit->id) }}">
                              {{ $unit->title }} 
                            </a>
                          </li>
                          @endforeach
                        </ul>

                        @else
                        <p class=" border-b border-zinc-200 dark:border-white/10">No Units allocated to this course.</p>
                      @endif
                    </div>

                  </div>

                  <footer
                    class="gid-cols-1 grid border-b border-neutral-200 px-6 py-4 font-medium text-zinc-800 dark:border-white/10">
                    <div class="flex gap-4">
                      <x-primary-button class="bg-zinc-800" type="button"
                        onclick="window.location.href='{{ route('courses.index', $course) }}'">
                        Return
                      </x-primary-button>
                      <form action="{{ route('courses.edit', $course) }}">
                        @csrf
                        <x-primary-button class="bg-zinc-800" href="">
                          Edit
                          <i class="fa-solid fa-edit order-first pr-2"></i>
                        </x-primary-button>
                      </form>
                      <form action="{{ route('courses.destroy', $course) }}" method="POST">
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