<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Progress for: ') }} {{ $student->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-bold text-lg mb-4">Course: {{ $course->name }}</h3>

                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <strong>Progress: </strong>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="h-2.5 rounded-full bg-green-500" style="width: {{ round($progressPercentage, 2) }}%"></div>
                        </div>
                        <div class="text-sm text-green-500 mt-1">{{ round($progressPercentage, 2) }}%</div>
                    </div>

                    <h4 class="font-semibold text-md mb-2">Completed Contents:</h4>
                    <ul class="list-disc list-inside">
                        @foreach($studentProgress as $progress)
                            <li class="mb-2">
                                <span class="text-blue-500">{{ $progress['content_title'] }}</span>
                                <span class="text-gray-500"> (Completed on: {{ $progress['completed_at'] }})</span>
                            </li>
                        @endforeach
                    </ul>

                    @if($studentProgress->isEmpty())
                        <p class="text-gray-600">This student has not completed any content yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
