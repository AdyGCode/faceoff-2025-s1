<x-guest-layout>
  <form
    method="POST"
    action="{{ route('register') }}"
    enctype="multipart/form-data"
  >
    @csrf

    <!-- Given Name -->
    <div>
      <x-input-label for="given_name" :value="__('Given Name')" />
      <x-text-input
        class="mt-1 block w-full"
        id="given_name"
        name="given_name"
        type="text"
        :value="old('given_name')"
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
        :value="old('family_name')"
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
        :value="old('name')"
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
            'he/him' => 'He/Him',
            'she/her' => 'She/Her',
            'they/them' => 'They/Them',
            'other' => 'Other',
        ]"
        :selected="old('preferred_pronouns')"
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
        :value="old('email')"
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
        required
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
        required
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
      <a class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        href="{{ route('login') }}"
      >
        {{ __('Already registered?') }}
      </a>

      <x-primary-button class="ms-4">
        {{ __('Register') }}
      </x-primary-button>
    </div>
  </form>
</x-guest-layout>
