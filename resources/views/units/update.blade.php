<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Face Off\'s Unit Update') }}
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
          <form method="POST" action="{{ route('units.update', $unit->id) }}">
            @csrf
            @method('PUT')

            <!-- National Code -->
            <div class="mt-4">
              <x-input-label for="national_code" :value="__('National Code')" />
              <x-text-input
                class="mt-1 block w-full"
                id="national_code"
                name="national_code"
                type="text"
                :value="old('national_code')?? $unit->national_code"
                autofocus
                required
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
                :value="old('title') ?? $unit->title"
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
                :selected="old('tga_status') ?? $unit->tga_status"
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
                :value="old('status_code') ?? $unit->status_code"
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
                :value="old('nominal_hours') ?? $unit->nominal_hours"
                autofocus
              />
              <x-input-error class="mt-2" :messages="$errors->get('nominal_hours')" />
            </div>

            <!-- Courses -->
            <div class="mt-4">
              <x-input-label for="course_id" :value="__('Courses')" />
              <div class="mt-1 w-full px-2 h-40 flex flex-wrap gap-4 overflow-y-auto">
                @foreach($courses as $course)
                  <label class="flex items-center w-1/2 md:w-1/3 lg:w-1/4">
                    <input 
                      type="checkbox" 
                      name="course_id[]" 
                      value="{{ $course->id }}" 
                      {{ in_array($course->id, old('course_id', $unit->courses->pluck('id')->toArray() ?? [])) ? 'checked' : '' }}
                      class="form-checkbox"
                    >
                    <span class="ml-2">{{ $course->title }}</span>
                  </label>
                @endforeach
              </div>
              <x-input-error class="mt-2" :messages="$errors->get('course_id')" />
            </div>

            <!-- Clusters -->
            <div class="mt-4">
              <x-input-label for="cluster_id" :value="__('Clusters')" />
              <div class="mt-1 w-full px-2 h-40 flex flex-wrap gap-4 overflow-y-auto">
                @foreach($clusters as $cluster)
                  <label class="flex items-center w-1/2 md:w-1/3 lg:w-1/4">
                    <input 
                      type="checkbox" 
                      name="cluster_id[]" 
                      value="{{ $cluster->id }}" 
                      {{ in_array($cluster->id, old('cluster_id', $unit->clusters->pluck('id')->toArray() ?? [])) ? 'checked' : '' }} 
                      class="form-checkbox"
                    >
                    <span class="ml-2">{{ $cluster->title }}</span>
                  </label>
                @endforeach
              </div>
              <x-input-error class="mt-2" :messages="$errors->get('cluster_id')" />
            </div>

            <div class="mt-4 flex items-center justify-end">

              <x-primary-button class="bg-zinc-800" type="button" onclick="window.location.href='{{ route('units.index') }}'">
                Cancel
              </x-primary-button>

              <x-primary-button class="ms-4">
                {{ __('Update unit') }}
              </x-primary-button>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</x-app-layout>
