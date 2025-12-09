@php use Illuminate\Support\Str; @endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-slate-500">Discover what's new</p>
                <h2 class="text-2xl font-semibold text-slate-900">Courses</h2>
            </div>
            @if(auth()->user()->isInstructor())
                <a href="{{ route('courses.create') }}"
                   class="inline-flex items-center gap-2 rounded-full bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-500">
                    <span class="text-lg">+</span>
                    Create course
                </a>
            @endif
        </div>
    </x-slot>

    <div class="bg-slate-50 py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
                @forelse($courses as $course)
                    <div class="group relative overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="h-2 bg-gradient-to-r from-indigo-500 via-violet-500 to-blue-500"></div>
                        <div class="p-6">
                            <div class="mb-3 flex items-center justify-between text-xs uppercase tracking-wide text-slate-500">
                                <span class="rounded-full bg-indigo-50 px-3 py-1 text-indigo-600">New</span>
                                <span>{{ $course->instructor?->name ?? 'Unknown instructor' }}</span>
                            </div>
                            <h3 class="text-lg font-semibold text-slate-900">{{ $course->title }}</h3>
                            <p class="mt-3 text-sm text-slate-600">
                                {{ Str::limit($course->short_description, 110) }}
                            </p>
                            <div class="mt-6 flex items-center justify-between">
                                <a href="{{ route('courses.show', $course) }}"
                                   class="inline-flex items-center gap-2 text-sm font-medium text-indigo-600 transition hover:text-indigo-500">
                                    View details
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                                @if(auth()->user()->id === $course->instructor_id)
                                    <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">My course</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-slate-200 bg-white p-10 text-center">
                            <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-indigo-50 text-indigo-600">📚</div>
                            <h3 class="text-lg font-semibold text-slate-900">No courses yet</h3>
                            <p class="mt-2 max-w-md text-sm text-slate-600">Courses will appear here as soon as instructors publish them. Check back soon!</p>
                            @if(auth()->user()->isInstructor())
                                <a href="{{ route('courses.create') }}" class="mt-4 inline-flex items-center gap-2 rounded-full bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-500">
                                    Create your first course
                                </a>
                            @endif
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

