<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Update Role') }}
            </h2>
        </div>
    </x-slot>

    @auth
        <x-flash-message :data="session()" />
    @endauth

    <div class="py-2">
        <div class="mx-auto max-w-7xl sm:px-2 lg:px-4">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <form method="POST" action="{{ route('roles.update', $role->id) }}">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="name" :value="__('Role Name')" />
                            <x-text-input
                                class="mt-1 block w-full"
                                id="name"
                                name="name"
                                type="text"
                                :value="old('name') ?? $role->name"
                                autofocus
                                autocomplete="role-name"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="permissions" :value="__('Permissions')" />
                            <div class="mt-2 grid grid-cols-2 gap-2 md:grid-cols-3 lg:grid-cols-4">
                                @foreach($permissions as $permission)
                                    <label class="flex items-center space-x-2">
                                        <input
                                            type="checkbox"
                                            name="permission[]"
                                            value="{{ $permission->id }}"
                                            @if(in_array($permission->id, old('permission', $rolePermissions))) checked @endif
                                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                        />
                                        <span class="text-sm text-gray-700">{{ $permission->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('permissions')" />
                        </div>

                        <div class="mt-4 flex items-center justify-end">
                            <footer class="flex gap-4 border-b border-neutral-200 px-6 py-4 font-medium text-zinc-800 dark:border-white/10">
                                <x-primary-button
                                    class="bg-zinc-800"
                                    type="button"
                                    onclick="window.location.href='{{ route('roles.index') }}'"
                                >
                                    Cancel
                                </x-primary-button>

                                <x-primary-button class="bg-zinc-800" type="submit">
                                    Update Role
                                </x-primary-button>
                            </footer>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
