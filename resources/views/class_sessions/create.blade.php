<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Face Off\'s Class Session Create') }}
        </h2>
    </x-slot>

    @auth
        <x-flash-message :data="session()" />
    @endauth

    <div class="py-2">
        <div class="mx-auto max-w-7xl sm:px-2 lg:px-4">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <form method="POST" action="{{ route('class_sessions.store') }}">
                        @csrf
                        <div class="mt-4">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input class="mt-1 block w-full" id="title" name="title" type="text" :value="old('title')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="date" :value="__('Date')" />
                            <x-text-input class="mt-1 block w-full" id="date" name="date" type="date" :value="old('date')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('date')" />
                        </div>

                        <div class="mt-4 flex items-center justify-end">
                            <x-primary-button class="bg-zinc-800" type="button" onclick="window.location.href='{{ route('class_sessions.index') }}'">
                                Cancel
                            </x-primary-button>

                            <x-primary-button class="ms-4">
                                {{ __('Add Class Session') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
