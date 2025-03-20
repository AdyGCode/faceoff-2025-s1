<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <!-- Courses Section -->
    <section class="py-16 px-6">
        <h2 class="text-3xl font-bold text-center mb-8">Our Courses</h2>
        <div class="grid md:grid-cols-3 gap-6 max-w-6xl mx-auto">
            @foreach($packages as $package)
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold">{{ $package->title }}</h3>
                    <p class="mt-2 text-gray-600">{{ $package->national_code }}</p>
                    <p class="mt-2 text-gray-600">{{ $package->tga_status }}</p>
                    <a href="{{ route('packages.show', $package->id) }}"
                       class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">
                        Learn More
                    </a>
                </div>
            @endforeach
        </div>
    </section>
</x-app-layout>

