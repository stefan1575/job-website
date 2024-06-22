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
                @if (request()->is('jobs*'))
                    @can('jobSeeker')
                        @php
                            $savedJob = Auth::user()
                                ->jobSeeker->savedJobs()
                                ->where('job_id', $job->id)
                                ->first();
                        @endphp
                        <div class="pb-2 flex">
                            <form method="POST" action="{{ route('apply.index') }}">
                                @csrf
                                <input type="hidden" id="job_id" name="job_id" value="{{ $job['id'] }}" />
                                @can('applyJob', $job)
                                    <button
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-3 border border-blue-700 rounded mr-2">
                                        {{ __('Apply now') }}
                                    </button>
                                @endcan
                                @cannot('applyJob', $job)
                                    <div
                                        class="cursor-not-allowed bg-blue-500/50 text-white font-bold py-1.5 px-3  rounded mr-2">
                                        {{ __('Applied') }}
                                    </div>
                                @endcannot
                            </form>

                            <form method="POST" action="{{ route('saved-jobs.toggle', $job) }}">
                                @csrf
                                @if (!$savedJob)
                                    <button
                                        class="font-semibold py-1.5 px-3 border border-gray-500/25 hover:bg-gray-500/25 rounded">
                                        {{ __('Save') }}
                                    </button>
                                @else
                                    <button
                                        class="font-semibold py-1.5 px-3 border border-gray-500/25 hover:bg-gray-500/25 rounded">
                                        {{ __('Unsave') }}
                                    </button>
                                @endif
                            </form>
                        </div>
                    @endcan
                @endif
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
