<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Face Off\'s Package Create') }}
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
          <form method="POST" action="{{ route('packages.store') }}">
            @csrf

            <!-- National Code -->
            <div>
              <x-input-label for="national_code" :value="__('National Code')" />
              <x-text-input
                class="mt-1 block w-full"
                id="national_code"
                name="national_code"
                type="text"
                :value="old('national_code')"
                autofocus
                autocomplete="national_code"
              />
              <x-input-error class="mt-2" :messages="$errors->get('national_code')" />
            </div>

            <!-- Title -->
            <div class="mt-4">
              <x-input-label for="title" :value="__('Title')" />
              <x-text-input
                class="mt-1 block w-full"
                id="title"
                name="title"
                type="text"
                :value="old('title')"
                autofocus
                autocomplete="title"
              />
              <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>

            <!-- TGA Status -->
            <div class="mt-4">
              <x-input-label for="tga_status" :value="__('TGA Status')" />

              <x-select
                class="mt-1 w-full"
                name="tga_status"
                :options="[
                    'current' => 'Current',
                    'expired' => 'Expired',
                    'replaced' => 'Replaced',
                ]"
                :selected="old('tga_status')"
                required
                autofocus
              />

              <x-input-error class="mt-2" :messages="$errors->get('tga_status')" />
            </div>

            <div class="mt-4 flex items-center justify-end">

              <x-primary-button class="bg-zinc-800" type="button" onclick="window.location.href='{{ route('packages.index') }}'">
                Cancel
              </x-primary-button>

              <x-primary-button class="ms-4">
                {{ __('Add package') }}
              </x-primary-button>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</x-app-layout>
