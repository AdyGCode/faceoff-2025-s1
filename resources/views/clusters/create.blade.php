<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Face Off\'s Cluster Create') }}
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
          <form method="POST" action="{{ route('clusters.store') }}">
            @csrf

            <!-- Code -->
            <div class="mt-4">
              <x-input-label for="code" :value="__('Code')" />
              <x-text-input
                class="mt-1 block w-full"
                id="code"
                name="code"
                type="text"
                :value="old('code')"
                autofocus
                required
              />
              <x-input-error class="mt-2" :messages="$errors->get('code')" />
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
                required
              />
              <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>

            <!-- Qualification -->
            <div class="mt-4">
              <x-input-label for="qualification" :value="__('Qualification')" />

              <x-text-input
                class="mt-1 w-full"
                id="qualification"
                name="qualification"
                type="text"
                :value="old('qualification')"
                required
                autofocus
              />

              <x-input-error class="mt-2" :messages="$errors->get('qualification')" />
            </div>

            <!-- Qualification State Code -->
            <div class="mt-4">
              <x-input-label for="qs_code" :value="__('Qualification State Code')" />
              <x-text-input
                class="mt-1 block w-full"
                id="qs_code"
                name="qs_code"
                type="text"
                :value="old('qs_code')"
                autofocus
              />
              <x-input-error class="mt-2" :messages="$errors->get('qs_code')" />
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
                      {{ in_array($course->id, old('course_id', [])) ? 'checked' : '' }} 
                      class="form-checkbox"
                    >
                    <span class="ml-2">{{ $course->title }}</span>
                  </label>
                @endforeach
              </div>
              <x-input-error class="mt-2" :messages="$errors->get('course_id')" />
            </div>

            <!-- Units -->
            <div class="mt-4">
              <x-input-label for="unit_id" :value="__('Units')" />
              <div class="mt-1 w-full px-2 h-40 flex flex-wrap gap-4 overflow-y-auto">
                @foreach($units as $unit)
                  <label class="flex items-center w-1/2 md:w-1/3 lg:w-1/4">
                    <input 
                      type="checkbox" 
                      name="unit_id[]" 
                      value="{{ $unit->id }}" 
                      {{ in_array($unit->id, old('unit_id', [])) ? 'checked' : '' }} 
                      class="form-checkbox"
                    >
                    <span class="ml-2">{{ $unit->title }}</span>
                  </label>
                @endforeach
              </div>
              <x-input-error class="mt-2" :messages="$errors->get('unit_id')" />
            </div>


            <div class="mt-4 flex items-center justify-end">

              <x-primary-button class="bg-zinc-800" type="button" onclick="window.location.href='{{ route('clusters.index') }}'">
                Cancel
              </x-primary-button>

              <x-primary-button class="ms-4">
                {{ __('Add Cluster') }}
              </x-primary-button>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</x-app-layout>
