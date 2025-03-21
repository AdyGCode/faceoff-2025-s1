<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Roles and Permissions') }}
            </h2>
            <a class="inline-flex items-center rounded bg-zinc-200 px-4 py-2 text-zinc-800 hover:bg-zinc-900 hover:text-white"
               href="{{ route('roles.create') }}">
                <i class="fa-solid fa-user-plus"></i>
                <span class="pl-4">Add Role</span>
            </a>
        </div>
    </x-slot>

    @auth
        <x-flash-message :data="session()" />
    @endauth

    <div class="py-4">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="text-gray-900 p-4">
                    <table class="min-w-full text-left text-sm font-light text-gray-800">
                        <thead class="border-b bg-zinc-800 text-white">
                        <tr>
                            <th class="px-6 py-4 w-10">#</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4">Permissions</th>
                            <th class="px-6 py-4">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr class="border-b border-gray-300">
                                <td class="px-6 py-4 font-medium">{{ $loop->index + 1 }}</td>
                                <td class="px-6 py-4"> {{ $role->name }}</td>
                                <td class="px-6 py-4">
                                    @foreach($role->permissions as $permission)
                                        <span class="bg-gray-200 text-black px-2 py-1 rounded">{{ $permission->name }}</span>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-4">
                                        <form action="{{ route('roles.show', $role) }}">
                                            <x-primary-button class="bg-zinc-800" href="{{ route('roles.show', $role) }}">
                                                <span>Show</span>
                                                <i class="fa-solid fa-eye order-first pr-2"></i>
                                            </x-primary-button>
                                        </form>
                                        <form action="{{ route('roles.edit', $role) }}" method="GET">
                                            @csrf
                                            <x-primary-button class="bg-blue-600" href="{{ route('roles.edit', $role) }}">
                                                <span>Edit</span>
                                                <i class="fa-solid fa-edit order-first pr-2"></i>
                                            </x-primary-button>
                                        </form>
                                        <form action="{{ route('roles.destroy', $role) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <x-secondary-button
                                                class="bg-red-600"
                                                type="submit"
                                                onclick="return confirm('Are you sure you want to delete this role?')"
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
                            <td colspan="4" class="px-6 py-2">
                                @if($roles->hasPages())
                                    {{ $roles->links() }}
                                @elseif($roles->total() === 0)
                                    <p class="text-lg text-gray-700">No roles found</p>
                                @else
                                    <p class="text-sm text-gray-800">All roles displayed</p>
                                @endif
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
