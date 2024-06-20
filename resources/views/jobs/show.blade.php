@props(['job' => $job])
<x-app-layout>
    <x-slot name="header">
        {{ __('Recent Jobs') }}
    </x-slot>
    <div class="grid grid-cols-2">
        <div>
            @foreach ($jobs as $singleJob)
                @include('components.job-card', ['job' => $singleJob, 'uri' => 'jobs'])
            @endforeach
        </div>
        <div>
            @include('components.job-card-expanded', ['job' => $job, 'uri' => 'jobs'])
        </div>
    </div>
</x-app-layout>
