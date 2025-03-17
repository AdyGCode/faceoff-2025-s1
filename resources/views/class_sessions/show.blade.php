<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div class="flex items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Face Off\'s Class Session Show') }}
                </h2>
            </div>
            <a class="inline-flex items-center rounded bg-zinc-200 px-4 py-2 text-zinc-800 hover:bg-zinc-900 hover:text-white"
               href="{{ route('class_sessions.create') }}">
                <i class="fa-solid fa-square-plus"></i>
                <span class="pl-4">Add Class Session</span>
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

                                    <div class="grid grid-cols-6 border-b border-neutral-200 bg-zinc-800 font-medium text-white dark:border-white/10">
                                        <p class="col-span-1 border-b border-zinc-200 px-6 py-4 dark:border-white/10">Item</p>
                                        <p class="col-span-3 border-b border-zinc-200 px-6 py-4 dark:border-white/10">Content</p>
                                    </div>

                                    <div class="grid grid-cols-6 border-b border-neutral-200 bg-white font-medium text-zinc-800 dark:border-white/10">
                                        <div class="col-span-1">
                                            <p class="border-b border-zinc-200 bg-zinc-300 px-6 py-4 dark:border-white/10">ID</p>
                                            <p class="border-b border-zinc-200 bg-zinc-300 px-6 py-4 dark:border-white/10">Title</p>
                                            <p class="border-b border-zinc-200 bg-zinc-300 px-6 py-4 dark:border-white/10">Start Time</p>
                                            <p class="border-b border-zinc-200 bg-zinc-300 px-6 py-4 dark:border-white/10">End Time</p>
                                            <p class="border-b border-zinc-200 bg-zinc-300 px-6 py-4 dark:border-white/10">Instructor</p>
                                            <p class="border-b border-zinc-200 bg-zinc-300 px-6 py-4 dark:border-white/10">Last update</p>
                                        </div>
                                        <div class="col-span-3">
                                            <p class="border-b border-zinc-200 px-6 py-4 dark:border-white/10">{{ $classSession->id }}</p>
                                            <p class="border-b border-zinc-200 px-6 py-4 dark:border-white/10">{{ $classSession->title }}</p>
                                            <p class="border-b border-zinc-200 px-6 py-4 dark:border-white/10">{{ $classSession->start_time }}</p>
                                            <p class="border-b border-zinc-200 px-6 py-4 dark:border-white/10">{{ $classSession->end_time }}</p>
                                            <p class="border-b border-zinc-200 px-6 py-4 dark:border-white/10">{{ $classSession->instructor }}</p>
                                            <p class="border-b border-zinc-200 px-6 py-4 dark:border-white/10">{{ $classSession->updated_at }}</p>
                                        </div>
                                    </div>

                                    <footer class="gid-cols-1 grid border-b border-neutral-200 px-6 py-4 font-medium text-zinc-800 dark:border-white/10">
                                        <div class="flex gap-4">
                                            <x-primary-button class="bg-zinc-800" type="button"
                                                              onclick="window.location.href='{{ route('class_sessions.index', $classSession) }}'">
                                                Return
                                            </x-primary-button>
                                            <form action="{{ route('class_sessions.edit', $classSession) }}">
                                                @csrf
                                                <x-primary-button class="bg-zinc-800">
                                                    Edit
                                                    <i class="fa-solid fa-edit order-first pr-2"></i>
                                                </x-primary-button>
                                            </form>
                                            <form action="{{ route('class_sessions.destroy', $classSession) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-secondary-button class="bg-zinc-200" type="submit"
                                                                    onclick="return confirm('Are you sure you want to delete this class session?')">
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
