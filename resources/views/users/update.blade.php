<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Face Off\'s User Update') }}
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
          <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <!-- Given Name -->
            <div>
              <x-input-label for="given_name" :value="__('Given Name')" />
              <x-text-input
                class="mt-1 block w-full"
                id="given_name"
                name="given_name"
                type="text"
                :value="old('given_name') ?? $user->given_name"
                autofocus
                autocomplete="given_name"
              />
              <x-input-error class="mt-2" :messages="$errors->get('given_name')" />
            </div>

            <!-- Family Name -->
            <div class="mt-4">
              <x-input-label for="family_name" :value="__('Family Name')" />
              <x-text-input
                class="mt-1 block w-full"
                id="family_name"
                name="family_name"
                type="text"
                :value="old('family_name') ?? $user->family_name"
                autofocus
                autocomplete="family_name"
              />
              <x-input-error class="mt-2" :messages="$errors->get('family_name')" />
            </div>

            <!-- Preferred Name -->
            <div class="mt-4">
              <x-input-label for="name" :value="__('Preferred Name (Optional)')" />
              <x-text-input
                class="mt-1 block w-full"
                id="name"
                name="name"
                type="text"
                :value="old('name') ?? $user->name"
                autofocus
                autocomplete="name"
              />
              <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <!-- Preferred Pronouns -->
            <div class="mt-4">
              <x-input-label for="preferred_pronouns" :value="__('Preferred Pronouns')" />

              <x-select
                class="mt-1 w-full"
                name="preferred_pronouns"
                :options="[
                    'He/Him' => 'He/Him',
                    'She/Her' => 'She/Her',
                    'They/Them' => 'They/Them',
                    'Other' => 'Other',
                ]"
                :selected="old('preferred_pronouns') ?? $user->preferred_pronouns"
                required
                autofocus
              />

              <x-input-error class="mt-2" :messages="$errors->get('preferred_pronouns')" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
              <x-input-label for="email" :value="__('Email')" />
              <x-text-input
                class="mt-1 block w-full"
                id="email"
                name="email"
                type="email"
                :value="old('email') ?? $user->email"
                autocomplete="username"
              />
              <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <!-- Password -->
            <div class="mt-4">
              <x-input-label for="password" :value="__('Password')" />

              <x-text-input
                class="mt-1 block w-full"
                id="password"
                name="password"
                type="password"
                autocomplete="new-password"
              />

              <x-input-error class="mt-2" :messages="$errors->get('password')" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
              <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

              <x-text-input
                class="mt-1 block w-full"
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
              />

              <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
            </div>

            <!-- Profile Photo -->
            <div class="mt-4">
              <x-input-label for="profile_photo" :value="__('Profile Photo')" />

              <x-file-input
                class="mt-1 block w-full"
                id="profile_photo"
                name="profile_photo"
                accept=".jpg, .jpeg, .png"
                autofocus
              />
              <p class="mt-1 text-sm text-gray-500">Acceptable formats: JPG, JPEG, PNG. Max size: 50KB</p>
              <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
            </div>

            <div class="mt-4 flex items-center justify-end">

              <footer
                class="flex gap-4 border-b border-neutral-200 px-6 py-4 font-medium text-zinc-800 dark:border-white/10"
              >

                <x-primary-button
                  class="bg-zinc-800"
                  type="button"
                  onclick="window.location.href='{{ route('users.show', $user) }}'"
                >
                  Cancel
                </x-primary-button>

                <x-primary-button class="bg-zinc-800" type="submit">
                  Update
                </x-primary-button>
              </footer>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
