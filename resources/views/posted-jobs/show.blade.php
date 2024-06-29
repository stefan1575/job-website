@props(['job' => $job])
<x-app-layout>
    <x-slot name="header">
        {{ __('Posted Jobs') }}
    </x-slot>
    <div class="grid grid-cols-2">
        <div>
            @foreach ($jobs as $singleJob)
                @include('components.job-card', [
                    'job' => $singleJob,
                    'uri' => 'posted-jobs',
                    'currentPage' => $jobs->currentPage(),
                ])
            @endforeach
        </div>
        <div>
            @include('components.job-card-expanded', ['job' => $job, 'uri' => 'posted-jobs'])
        </div>
    </div>
    <div class="mt-8">{{ $jobs->links() }}</div>
</x-app-layout>
