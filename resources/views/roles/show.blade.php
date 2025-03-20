<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div class="flex items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Face Off\'s Role Show') }}
                </h2>
            </div>
            <a class="inline-flex items-center rounded bg-zinc-200 px-4 py-2 text-zinc-800 hover:bg-zinc-900 hover:text-white"
               href="{{ route('roles.create') }}"
            >
                <i class="fa-solid fa-user-plus"></i>
                <span class="pl-4">Add Role</span>
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
                                <div class="text-surface min-w-full text-left text-sm font-light dark:text-white">
                                    <header
                                        class="grid grid-cols-6 border-b border-neutral-200 bg-zinc-800 font-medium text-white dark:border-white/10"
                                    >
                                        <p class="col-span-1 border-b border-zinc-200 px-6 py-4 dark:border-white/10">Item</p>

                                        <p class="col-span-4 border-b border-zinc-200 px-6 py-4 dark:border-white/10">Content</p>

                                    </header>
                                    <section
                                        class="grid grid-cols-6 border-b border-neutral-200 bg-white font-medium text-zinc-800 dark:border-white/10"
                                    >
                                        <p class="col-span-1 whitespace-nowrap border-b border-zinc-200 bg-zinc-300 px-6 py-4 dark:border-white/10">
                                            Role
                                        </p>
                                        <p class="col-span-5 whitespace-nowrap border-b border-zinc-200 px-6 py-4 dark:border-white/10">
                                            {{ $role->name }}
                                        </p>

                                        <p class="col-span-1 whitespace-nowrap border-b border-zinc-200 bg-zinc-300 px-6 py-4 dark:border-white/10">
                                            Permissions
                                        </p>
                                        <p class="col-span-5 border-b border-zinc-200 px-6 py-4 dark:border-white/10">
                                            @foreach($rolePermissions as $permission)
                                                <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded-md text-sm">
                                                    {{ $permission->name }}
                                                    </span>
                                            @endforeach
                                        </p>
                                        <p class="col-span-1 whitespace-nowrap border-b border-zinc-200 bg-zinc-300 px-6 py-4 dark:border-white/10">
                                            Last update
                                        </p>
                                        <p class="col-span-5 whitespace-nowrap border-b border-zinc-200 px-6 py-4 dark:border-white/10">
                                            {{ $role->updated_at }}
                                        </p>
                                    </section>


                                    <footer
                                        class="gid-cols-1 grid border-b border-neutral-200 px-6 py-4 font-medium text-zinc-800 dark:border-white/10"
                                    >
                                        <div class="flex gap-4">
                                            <x-primary-button
                                                class="bg-zinc-800"
                                                type="button"
                                                onclick="window.location.href='{{ route('roles.index', $role) }}'"
                                            >
                                                Return
                                            </x-primary-button>
                                            <form action="{{ route('roles.edit', $role) }}">
                                                @csrf
                                                <x-primary-button class="bg-zinc-800" href="">
                                                    Edit
                                                    <i class="fa-solid fa-edit order-first pr-2"></i>
                                                </x-primary-button>
                                            </form>
                                            <form action="users.destroy" method="POST">
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
