<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Face Off\'s Class Sessions') }}
            </h2>
            <a class="inline-flex items-center rounded bg-zinc-200 px-4 py-2 text-zinc-800 hover:bg-zinc-900 hover:text-white"
               href="{{ route('class_sessions.create') }}">

                <i class="fa-solid fa-square-plus"></i>
                <span class="pl-4">Add Class Session</span>
            </a>
        </div>
    </x-slot>

    @auth
        <x-flash-message :data="session()" />
    @endauth

    <div class="py-2">
        <div class="mx-auto max-w-7xl sm:px-2 lg:px-4">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <article class="-mx-4">
                        <section class="mt-4 grid grid-cols-1 gap-4 px-4 sm:px-8">

                            <section class="min-w-full items-center overflow-hidden rounded border border-zinc-600 bg-zinc-50">

                                <table class="text-surface min-w-full text-left text-sm font-light dark:text-white">
                                    <thead class="border-b border-neutral-200 bg-zinc-800 font-medium text-white dark:border-white/10">
                                    <tr>
                                        <th class="px-6 py-4" width="10%" scope="col">#</th>
                                        <th class="px-6 py-4" width="20%" scope="col">Title</th>
                                        <th class="px-6 py-4" width="20%" scope="col">Cluster</th>
                                        <th class="px-6 py-4" width="20%" scope="col">Lecturer</th>
                                        <th class="px-6 py-4" width="20%" scope="col">Students</th>
                                        <th class="px-6 py-4" width="20%" scope="col">Start Date</th>
                                        <th class="px-6 py-4" width="20%" scope="col">End Date</th>
                                        <th class="px-6 py-4" width="20%" scope="col">Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($classSessions as $classSession)
                                        <tr class="border-b border-zinc-300 text-black dark:border-white/10">
                                            <td class="px-6 py-4 font-medium">
                                                {{ $loop->index + 1 + ($classSessions->currentPage() - 1) * $classSessions->perPage() }}
                                            </td>
                                            <td class="px-6 py-4">{{ $classSession->title }}</td>
                                            <td class="px-6 py-4">{{ $classSession->cluster->title }}</td>
                                            <!-- The lecturer's full name -->
                                            <td class="px-6 py-4">{{ $classSession->staff?->given_name ?? '—' }}
                                                {{ $classSession->staff?->family_name ?? '—' }}</td>
                                            <td class="px-6 py-4">
                                                @if($classSession->students->count())
                                                    <ul class="list-disc list-inside">
                                                        @foreach($classSession->students as $student)
                                                            <li>{{ $student->given_name }} {{ $student->family_name }}</li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <span class="text-zinc-500 italic">No students</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">{{ $classSession->start_date }}</td>
                                            <td class="px-6 py-4">{{ $classSession->end_date }}</td>
                                            <td class="px-6 py-4">
                                                <div class="flex gap-4">
                                                    <a class="bg-zinc-800 px-4 py-2 text-white rounded" href="{{ route('class_sessions.show', $classSession) }}">
                                                        <i class="fa-solid fa-eye pr-2"></i> Show
                                                    </a>
                                                    <a class="bg-zinc-800 px-4 py-2 text-white rounded" href="{{ route('class_sessions.edit', $classSession) }}">
                                                        <i class="fa-solid fa-edit pr-2"></i> Edit
                                                    </a>
                                                    <form action="{{ route('class_sessions.destroy', $classSession) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-zinc-200 px-4 py-2 text-black rounded"
                                                                onclick="return confirm('Are you sure you want to delete this session?')">
                                                            <i class="fa-solid fa-times pr-2"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                    <tfoot>
                                    <tr class="bg-zinc-100">
                                        <td class="px-6 py-2" colspan="6">
                                            @if ($classSessions->hasPages())
                                                {{ $classSessions->links() }}
                                            @elseif($classSessions->total() === 0)
                                                <p class="py-2 text-sm text-zinc-800">No class sessions found</p>
                                            @else
                                                <p class="py-2 text-sm text-zinc-800">All class sessions shown</p>
                                            @endif
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </section>
                        </section>
                    </article>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
