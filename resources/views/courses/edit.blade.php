<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500">Instructor workspace</p>
                <h2 class="text-2xl font-semibold text-slate-900">Edit course</h2>
            </div>
            <a href="{{ route('courses.show', $course) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View course</a>
        </div>
    </x-slot>

    <div class="bg-slate-50 py-12">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-slate-100 bg-white p-8 shadow-sm">
                <form id="update-course-form" method="POST" action="{{ route('courses.update', $course) }}" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autofocus value="{{ old('title', $course->title) }}" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="short_description" :value="__('Short Description')" />
                        <textarea id="short_description" name="short_description" rows="3" class="mt-1 w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500" required>{{ old('short_description', $course->short_description) }}</textarea>
                        <x-input-error :messages="$errors->get('short_description')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="content" :value="__('Course Content')" />
                        <textarea id="content" name="content" rows="8" class="mt-1 w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500" required>{{ old('content', $course->content) }}</textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                </form>

                <div class="mt-6 flex flex-wrap items-center justify-between gap-3 border-t border-slate-100 pt-6">
                    <div class="flex items-center gap-3">
                        <div class="h-9 w-9 rounded-full bg-indigo-50 text-center text-xl leading-9 text-indigo-600">ℹ️</div>
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Finish up</p>
                            <p class="text-xs text-slate-500">Save your changes or manage this course.</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ route('courses.show', $course) }}" class="text-sm font-medium text-slate-600 hover:text-slate-800">Cancel</a>
                        <x-primary-button form="update-course-form">Save changes</x-primary-button>
                        <form id="delete-course-form" method="POST" action="{{ route('courses.destroy', $course) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-2 rounded-full border border-rose-200 px-4 py-2 text-sm font-medium text-rose-600 transition hover:bg-rose-50" onclick="return confirm('Delete this course?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

