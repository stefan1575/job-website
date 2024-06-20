@props(['job' => $job, 'uri' => $uri ?? null])

<div class="py-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="block p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <div class="pb-2">
                    <img class="w-16 h-16" src="{{ asset($job->employer->logo) }}" alt="" />
                    <div class="my-2 text-2xl font-bold tracking-tight text-gray-900">
                        {{ $job['title'] }}
                    </div>
                    <div>{{ $job->employer->name }}</div>
                </div>
                <div class="pb-2">
                    <div>{{ $job['location'] }}</div>
                </div>
                <div class="pb-2">${{ $job['salary'] }} a month - {{ $job['schedule'] }}</div>

                @can('editJob', $job)
                    <div class="pb-2 flex">
                        <a href="/{{ $uri }}/{{ $job->id }}/edit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-3 border border-blue-700 rounded mr-2">
                            {{ __('Edit Job') }}
                        </a>
                    </div>
                @endcan
                <div class="">
                    {{ $job['description'] }}
                </div>
            </div>
        </div>
    </div>
</div>
