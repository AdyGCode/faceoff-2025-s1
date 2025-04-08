<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="sm:px-6 lg:px-8 pb-10">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <!-- Courses Section -->
    <section class="py-10 px-6">
        <h2 class="text-3xl font-bold text-left mb-8">Our Courses</h2>
        <div class="grid md:grid-cols-3 gap-6 max-w-6xl mx-auto">
            @foreach($courses as $course)
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold">{{ $course->title }}</h3>
                    <p class="mt-2 text-gray-600">{{ $course->national_code }}</p>
                    <p class="mt-2 text-gray-600">{{ $course->tga_status }}</p>
                    <a href="{{ route('courses.show', $course->id) }}"
                       class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">
                        Learn More
                    </a>
                </div>
            @endforeach
        </div>
    </section>
</x-app-layout>

