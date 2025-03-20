<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Face Off\'s Course Update') }}
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
          <form method="POST" action="{{ route('courses.update', $course->id) }}">
            @csrf
            @method('PUT')

            <!-- Package -->
            <div>
              <x-input-label for="package_id" :value="__('Package')" />

              <x-select
                class="mt-1 w-full"
                name="package_id"
                :options="$packages->pluck('title', 'id')->toArray()"
                :selected="old('package_id') ?? $course->package_id"
                required
                autofocus
              />
              <x-input-error class="mt-2" :messages="$errors->get('package_id')" />
            </div>

            <!-- National Code -->
            <div class="mt-4">
              <x-input-label for="national_code" :value="__('National Code')" />
              <x-text-input
                class="mt-1 block w-full"
                id="national_code"
                name="national_code"
                type="text"
                :value="old('national_code')?? $course->national_code"
                autofocus
                required
              />
              <x-input-error class="mt-2" :messages="$errors->get('national_code')" />
            </div>

            <!-- AQF Level -->
            <div class="mt-4">
              <x-input-label for="aqf_level" :value="__('AQF Level')" />

              <x-select
                class="mt-1 w-full"
                name="aqf_level"
                :options="[
                    'certificate I in' => 'Certificate I in',
                    'certificate II in' => 'Certificate II in',
                    'certificate III in' => 'Certificate III in',
                    'certificate IV in' => 'Certificate IV in',
                    'diploma of' => 'Diploma of',
                    'advanced diploma of' => 'Advanced Diploma of',
                    'graduate diploma of' => 'Graduate Diploma of',
                ]"
                :selected="old('aqf_level')?? $course->aqf_level"
                required
                autofocus
              />

              <x-input-error class="mt-2" :messages="$errors->get('aqf_level')" />
            </div>

            <!-- Title -->
            <div class="mt-4">
              <x-input-label for="title" :value="__('Title')" />
              <x-text-input
                class="mt-1 block w-full"
                id="title"
                name="title"
                type="text"
                :value="old('title') ?? $course->title"
                autofocus
                required
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
                :selected="old('tga_status') ?? $course->tga_status"
                required
                autofocus
              />

              <x-input-error class="mt-2" :messages="$errors->get('tga_status')" />
            </div>

            <!-- Status Code -->
            <div class="mt-4">
              <x-input-label for="status_code" :value="__('Status Code')" />
              <x-text-input
                class="mt-1 block w-full"
                id="status_code"
                name="status_code"
                type="text"
                :value="old('status_code') ?? $course->status_code"
                autofocus
              />
              <x-input-error class="mt-2" :messages="$errors->get('status_code')" />
            </div>

            <!-- Nominal Hours -->
            <div class="mt-4">
              <x-input-label for="nominal_hours" :value="__('Nominal Hours')" />
              <x-text-input
                class="mt-1 block w-full"
                id="nominal_hours"
                name="nominal_hours"
                type="text"
                :value="old('nominal_hours') ?? $course->nominal_hours"
                autofocus
              />
              <x-input-error class="mt-2" :messages="$errors->get('nominal_hours')" />
            </div>

            <div class="mt-4 flex items-center justify-end">

              <x-primary-button class="bg-zinc-800" type="button" onclick="window.location.href='{{ route('courses.index') }}'">
                Cancel
              </x-primary-button>

              <x-primary-button class="ms-4">
                {{ __('Update Course') }}
              </x-primary-button>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</x-app-layout>
