<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($courses->isEmpty())
                        <p>No courses available yet.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($courses as $course)
                                <div class="border rounded-lg p-4 hover:shadow-lg transition">
                                    <h3 class="text-lg font-bold mb-2">{{ $course->title }}</h3>
                                    <p class="text-sm text-gray-600 mb-2">By {{ $course->instructor->name }}</p>
                                    <p class="text-gray-700 mb-4">{{ Str::limit($course->short_description, 100) }}</p>
                                    <a href="{{ route('courses.show', $course) }}" class="text-blue-600 hover:underline">View Course →</a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>