<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500">Instructor workspace</p>
                <h2 class="text-2xl font-semibold text-slate-900">Create course</h2>
            </div>
            <a href="{{ route('courses.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Back to courses</a>
        </div>
    </x-slot>

    <div class="bg-slate-50 py-12">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-slate-100 bg-white p-8 shadow-sm">
                <form method="POST" action="{{ route('courses.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autofocus value="{{ old('title') }}" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="short_description" :value="__('Short Description')" />
                        <textarea id="short_description" name="short_description" rows="3" class="mt-1 w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500" required>{{ old('short_description') }}</textarea>
                        <x-input-error :messages="$errors->get('short_description')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="content" :value="__('Course Content')" />
                        <textarea id="content" name="content" rows="8" class="mt-1 w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500" required>{{ old('content') }}</textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('courses.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-800">Cancel</a>
                        <x-primary-button>
                            {{ __('Publish course') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

