@props(['profilePhoto', 'userName'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link href="https://fonts.bunny.net" rel="preconnect">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  {{-- FontAwesome cdn --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="font-sans antialiased" >
  <div class="flex">
    {{-- aside menu --}}
    <x-aside-menu.index
      class="m-4 shadow-xl"
      bgColor='bg-[#D42329]'
      textColor='text-white'
      profilePhoto="{{ $profilePhoto }}"
      userName="{{ $userName }}"
    ></x-aside-menu.index>
    <div class="flex-grow">
      <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
          <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
              {{ $header }}
            </div>
          </header>
        @endisset

        <!-- Page Content -->
        <main>
          aaa
          {{ $slot }}
        </main>

      </div>
    </div>
    {{-- Footer section --}}
    <x-footer class="font-[800] h-full text-white">All contents © Government of Western Australia 2025 . All rights reserved. </x-footer>
</body>

</html>
