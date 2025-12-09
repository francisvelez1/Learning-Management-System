@php use Illuminate\Support\Str; @endphp

<x-app-layout>
    {{-- HERO SECTION --}}
    <div class="bg-gradient-to-br from-slate-900 via-indigo-900 to-slate-800">
        <div class="mx-auto flex max-w-7xl flex-col gap-10 px-4 py-16 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
            
            {{-- LEFT SIDE --}}
            <div class="max-w-2xl space-y-6 text-white">
                <p class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-sm font-medium text-indigo-100 ring-1 ring-white/10">
                    🎯 Learn. Build. Grow.
                </p>

                <h1 class="text-4xl font-bold leading-tight sm:text-5xl">
                    A modern LMS for fast, focused learning.
                </h1>

                <p class="text-lg text-indigo-100/90">
                    Browse curated courses, track your progress, and teach with ease. Clean design, zero clutter.
                </p>

                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('courses.index') }}"
                       class="inline-flex items-center gap-2 rounded-full bg-white px-5 py-2.5 text-sm font-semibold text-slate-900 shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg">
                        Explore courses
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>

                    @auth
                        @if(auth()->user()->isInstructor())
                            <a href="{{ route('courses.create') }}"
                               class="inline-flex items-center gap-2 rounded-full border border-white/40 px-5 py-2.5 text-sm font-semibold text-white transition hover:border-white hover:bg-white/10">
                                Create a course
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}"
                               class="inline-flex items-center gap-2 rounded-full border border-white/40 px-5 py-2.5 text-sm font-semibold text-white transition hover:border-white hover:bg-white/10">
                                Go to dashboard
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center gap-2 rounded-full border border-white/40 px-5 py-2.5 text-sm font-semibold text-white transition hover:border-white hover:bg-white/10">
                            Sign in
                        </a>
                    @endauth
                </div>

                <div class="flex flex-wrap gap-4 text-sm text-indigo-100/80">
                    <div class="rounded-xl bg-white/10 px-4 py-3 ring-1 ring-white/10">
                        <div class="text-xl font-semibold text-white">{{ $courses->count() }}</div>
                        <div>Courses live</div>
                    </div>

                    <div class="rounded-xl bg-white/10 px-4 py-3 ring-1 ring-white/10">
                        <div class="text-xl font-semibold text-white">Fast</div>
                        <div>Modern UI built with Tailwind</div>
                    </div>

                    <div class="rounded-xl bg-white/10 px-4 py-3 ring-1 ring-white/10">
                        <div class="text-xl font-semibold text-white">Secure</div>
                        <div>Auth-only dashboards</div>
                    </div>
                </div>
            </div>

            {{-- RIGHT SIDE: LATEST COURSES CARD --}}
            <div class="w-full max-w-xl rounded-2xl bg-white/5 p-[1px] shadow-2xl ring-1 ring-white/10 backdrop-blur">
                <div class="h-full rounded-2xl bg-slate-900/70 p-6">
                    <h3 class="mb-4 text-lg font-semibold text-white">Latest courses</h3>

                    <div class="space-y-4">
                        @forelse($courses as $course)
                            <a href="{{ route('courses.show', $course) }}"
                               class="block rounded-xl border border-white/5 bg-white/5 p-4 shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-300/60 hover:bg-white/10">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="text-xs uppercase tracking-wide text-indigo-100/80">Instructor</p>
                                        <p class="text-sm font-semibold text-white">{{ $course->instructor->name ?? 'Unknown' }}</p>
                                    </div>
                                    <span class="rounded-full bg-indigo-500/20 px-3 py-1 text-xs font-semibold text-indigo-100">New</span>
                                </div>

                                <h4 class="mt-3 text-base font-semibold text-white">{{ $course->title }}</h4>
                                <p class="mt-2 text-sm text-indigo-100/80">{{ Str::limit($course->short_description, 110) }}</p>
                            </a>
                        @empty
                            <div class="rounded-xl border border-dashed border-white/20 p-6 text-center text-indigo-100/90">
                                No courses yet. Check back soon!
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- COURSE CATALOG SECTION --}}
    <div class="bg-white py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col gap-3">
                <p class="text-sm font-semibold uppercase tracking-wide text-indigo-600">Courses</p>

                <div class="flex flex-wrap items-center justify-between gap-3">
                    <h2 class="text-2xl font-bold text-slate-900">Explore the catalog</h2>
                    <a href="{{ route('courses.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                        View all →
                    </a>
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                
                @forelse($courses as $course)
                    <div class="group relative overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="h-1.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-blue-500"></div>

                        <div class="p-6">
                            <div class="flex items-center justify-between text-xs uppercase tracking-wide text-slate-500">
                                <span>By {{ $course->instructor->name ?? 'Unknown' }}</span>
                                <span class="rounded-full bg-indigo-50 px-3 py-1 text-indigo-600">Course</span>
                            </div>

                            <h3 class="mt-3 text-lg font-semibold text-slate-900">{{ $course->title }}</h3>
                            <p class="mt-2 text-sm text-slate-600">{{ Str::limit($course->short_description, 120) }}</p>

                            <div class="mt-4 flex items-center justify-between">
                                <a href="{{ route('courses.show', $course) }}"
                                   class="inline-flex items-center gap-2 text-sm font-medium text-indigo-600 transition group-hover:text-indigo-500">
                                    View course
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>

                                @if(auth()->check() && auth()->user()->id === $course->instructor_id)
                                    <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">My course</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-10 text-center">
                            <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-indigo-100 text-indigo-600">📚</div>
                            <h3 class="text-lg font-semibold text-slate-900">No courses yet</h3>
                            <p class="mt-2 max-w-md text-sm text-slate-600">Courses will appear here as soon as instructors publish them.</p>

                            @auth
                                @if(auth()->user()->isInstructor())
                                    <a href="{{ route('courses.create') }}"
                                       class="mt-4 inline-flex items-center gap-2 rounded-full bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-500">
                                        Create your first course
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('register') }}"
                                   class="mt-4 inline-flex items-center gap-2 rounded-full bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-500">
                                    Get started
                                </a>
                            @endauth
                        </div>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
