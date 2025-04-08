@php use Carbon\Carbon; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Face Off\'s Class Session Update') }}
        </h2>
    </x-slot>

    @auth
        <x-flash-message :data="session()"/>
    @endauth

    <div class="py-2">
        <div class="mx-auto max-w-7xl sm:px-2 lg:px-4">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <form method="POST" action="{{ route('class_sessions.update', $classSession->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mt-4">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input class="mt-1 block w-full"
                                          id="title"
                                          name="title"
                                          type="text"
                                          :value="old('title')?? $classSession->title"
                                          autofocus
                                          required
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <!-- Cluster -->
                        <div class="mt-4">
                            <x-input-label for="cluster_id" :value="__('Cluster')"/>
                            <select name="cluster_id" id="cluster_id" class="mt-1 block w-full border-gray-300 rounded">
                                @foreach ($clusters as $cluster)
                                    <option value="{{ $cluster->id }}"
                                        {{ old('cluster_id', $classSession->cluster_id) == $cluster->id ? 'selected' : '' }}>
                                        {{ $cluster->title }}
                                    </option>

                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('cluster_id')"/>
                        </div>

                        <!-- Staff -->
                        <div class="mt-4">
                            <x-input-label for="user_id" :value="__('Lecturer')"/>
                            <select name="user_id" id="user_id" class="mt-1 block w-full border-gray-300 rounded">
                                @foreach ($staff as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('user_id', $classSession->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->given_name }} {{ $user->family_name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('user_id')"/>
                        </div>

                        <!-- Students -->
                        <div class="mt-4">
                            <x-input-label for="students" :value="__('Students')"/>
                            <div class="mt-1 w-full px-2 h-40 flex flex-wrap gap-4 overflow-y-auto">
                                @php
                                    $selectedStudentIds = old('student_id', $classSession->students->pluck('id')->toArray());
                                @endphp

                                @foreach ($students as $student)
                                    <label class="flex items-center w-1/2 md:w-1/3 lg:w-1/4">
                                        <input
                                            type="checkbox"
                                            name="students[]"
                                            value="{{ $student->id }}"
                                            {{ in_array($student->id, old('students', $classSession->students->pluck('id')->toArray())) ? 'checked' : '' }}
                                        >
                                        <span class="ml-2">{{ $student->given_name }} {{ $student->family_name }}</span>
                                    </label>
                                @endforeach

                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('students')"/>
                        </div>

                        @php
                            $start = Carbon::parse(old('start_date', $classSession->start_date));
                            $end = Carbon::parse(old('end_date', $classSession->end_date));
                        @endphp

                            <!-- Dates -->
                        <div class="mt-4">
                            <x-input-label for="start_date" :value="__('Start Date')"/>
                            <x-text-input
                                class="mt-1 block w-full"
                                id="start_date"
                                name="start_date"
                                type="datetime-local"
                                value="{{ old('start_date', $start->format('Y-m-d\TH:i')) }}"
                                required
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('start_date')"/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="end_date" :value="__('End Date')"/>
                            <x-text-input
                                class="mt-1 block w-full"
                                id="end_date"
                                name="end_date"
                                type="datetime-local"
                                value="{{ old('end_date', $end->format('Y-m-d\TH:i')) }}"
                                required
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('end_date')"/>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-4 flex items-center justify-end">
                            <x-primary-button class="bg-zinc-800" type="button"
                                              onclick="window.location.href='{{ route('class_sessions.index') }}'">
                                Cancel
                            </x-primary-button>
                            <x-primary-button class="ms-4">
                                {{ __('Update Class Session') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

