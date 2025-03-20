<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Add Role') }}
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
                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf

                        <!-- Role Name -->
                        <div>
                            <x-input-label for="name" :value="__('Role Name')" />
                            <x-text-input
                                class="mt-1 block w-full"
                                id="name"
                                name="name"
                                type="text"
                                :value="old('name')"
                                autofocus
                                autocomplete="name"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="permissions" :value="__('Permissions')" />
                            <div class="space-y-2">
                                @foreach ($permissions as $permission)
                                    <div class="flex items-center">
                                        <input
                                            type="checkbox"
                                            class="mr-2"
                                            name="permissions[]"
                                            value="{{ $permission->id }}"
                                            id="permission-{{ $permission->id }}"
                                            {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}
                                        />
                                        <label for="permission-{{ $permission->id }}" class="text-sm">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('permissions')" />
                        </div>

                        <div class="mt-4 flex items-center justify-end">
                            <x-primary-button class="ms-4">
                                {{ __('Add Role') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



