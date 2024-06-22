<x-app-layout>
    <x-slot name="header">
        {{ __('Saved Jobs') }}
    </x-slot>
    @if (!$savedJobs->isEmpty())
        @foreach ($savedJobs as $savedJob)
            @php
                $job = $savedJob->job;
            @endphp
            <a class="py-2" href="/jobs/{{ $job->id }}">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="block p-4 sm:p-8 bg-white shadow sm:rounded-lg hover:border-blue-500/50 border-2">
                        <div class="max-w-xl flex content-center">
                            <div>
                                <img class="mt-2 w-12 h-12 mr-6" src="{{ asset($job->employer->logo) }}" alt="" />
                            </div>
                            <div>
                                <div class="font-semibold text-xl">{{ $job['title'] }}</div>
                                <div>{{ $job->employer->name }}</div>
                                <div>{{ $job['location'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("You haven't saved any jobs") }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
