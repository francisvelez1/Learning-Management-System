@php use Illuminate\Support\Str; @endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <p class="text-sm text-slate-500">Welcome back, {{ auth()->user()->name }}</p>
            <h2 class="text-2xl font-semibold text-slate-900">Instructor dashboard</h2>
            <p class="text-sm text-slate-500">Manage your courses and publish new ones.</p>
        </div>
    </x-slot>

    <div class="bg-slate-50 py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="h-11 w-11 rounded-xl bg-indigo-100 text-center text-xl leading-10 text-indigo-600">🎯</div>
                    <div>
                        <p class="text-sm font-semibold text-slate-900">Your courses</p>
                        <p class="text-xs text-slate-500">A quick overview of everything you teach.</p>
                    </div>
                </div>
                <a href="{{ route('courses.create') }}" class="inline-flex items-center gap-2 rounded-full bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-500">
                    + New course
                </a>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
                @forelse($courses as $course)
                    <div class="group relative overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="h-2 bg-gradient-to-r from-indigo-500 via-violet-500 to-blue-500"></div>
                        <div class="p-6">
                            <div class="flex items-center justify-between text-xs uppercase tracking-wide text-slate-500">
                                <span class="rounded-full bg-emerald-50 px-3 py-1 text-emerald-700">Published</span>
                                <span>{{ $course->updated_at->diffForHumans() }}</span>
                            </div>
                            <h3 class="mt-3 text-lg font-semibold text-slate-900">{{ $course->title }}</h3>
                            <p class="mt-2 text-sm text-slate-600">{{ Str::limit($course->short_description, 110) }}</p>

                            <div class="mt-5 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('courses.show', $course) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Preview</a>
                                    <a href="{{ route('courses.edit', $course) }}" class="text-sm font-medium text-slate-700 hover:text-slate-900">Edit</a>
                                </div>
                                <form method="POST" action="{{ route('courses.destroy', $course) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm font-medium text-rose-600 hover:text-rose-500" onclick="return confirm('Delete this course?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-slate-200 bg-white p-10 text-center">
                            <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-indigo-50 text-indigo-600">🚀</div>
                            <h3 class="text-lg font-semibold text-slate-900">No courses yet</h3>
                            <p class="mt-2 max-w-md text-sm text-slate-600">Publish your first course to share knowledge with your students.</p>
                            <a href="{{ route('courses.create') }}" class="mt-4 inline-flex items-center gap-2 rounded-full bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-500">
                                Create your first course
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

