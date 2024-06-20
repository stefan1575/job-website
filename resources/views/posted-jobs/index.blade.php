<x-app-layout>
    <x-slot name="header">
        {{ __('Posted Jobs') }}
    </x-slot>
    <div class="grid grid-cols-2">
        <div>
            @foreach ($jobs as $job)
                @include('components.job-card', ['job' => $job, 'uri' => 'posted-jobs'])
            @endforeach
        </div>
        <div>
            @if (!$jobs->isEmpty())
                @include('components.job-card-expanded', ['job' => $jobs[0], 'uri' => 'posted-jobs'])
            @endif
        </div>
    </div>
</x-app-layout>
