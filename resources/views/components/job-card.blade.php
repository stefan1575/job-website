@props(['job' => $job, 'uri' => $uri])

@php
    $active =
        request()->is($uri . '/' . $job->id) ?? false
            ? 'block p-4 sm:p-8 bg-white shadow sm:rounded-lg border-blue-500 border-2'
            : 'block p-4 sm:p-8 bg-white shadow sm:rounded-lg border-transparent hover:border-blue-500/50 border-2';
@endphp

<div class="py-2">
    <div class="relative max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <a href="/{{ $uri }}/{{ $job->id }}" class="{{ $active }}">
            <div class="max-w-xl">
                <div class="pb-2 flex place-content-between">
                    <div>
                        <img class="w-16 h-16" src="{{ asset($job->employer->logo) }}" alt="Employer Logo" />
                        <div class="my-2 text-2xl font-bold tracking-tight text-gray-900">
                            {{ $job['title'] }}
                        </div>
                        <div>{{ $job->employer->name }}</div>
                    </div>
                </div>
                <div class="pb-2">
                    <div>{{ $job['location'] }}</div>
                </div>
                <div class="pb-2">${{ $job['salary'] }} a month - {{ $job['schedule'] }}</div>
                <div class="font-normal text-gray-700 line-clamp-3">
                    {{ $job['description'] }}
                </div>
            </div>
        </a>
        @can('jobSeeker')
            @php
                $savedJob = Auth::user()
                    ->jobSeeker->savedJobs()
                    ->where('job_id', $job->id)
                    ->first();

                $saved = $savedJob ?? false ? 'stroke-black/80 fill-black' : 'stroke-black/80';
            @endphp
            <div>
                <form method="POST" action="{{ route('saved-jobs.toggle', $job) }}">
                    @csrf
                    <button class="absolute top-4 right-12 block p-1 rounded-md hover:bg-gray-500/25">
                        <x-bookmark class="{{ $saved }}" />
                    </button>
                </form>
            </div>
        @endcan
    </div>
</div>
