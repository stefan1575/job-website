<x-app-layout>
    <x-slot name="header">
        {{ __('Recent Jobs') }}
    </x-slot>
    <div class="grid grid-cols-2">
        <div>
            @foreach ($jobs as $job)
                @include('components.job-card', ['job' => $job, 'uri' => 'jobs'])
            @endforeach
        </div>
        <div>
            @if (!$jobs->isEmpty())
                @include('components.job-card-expanded', ['job' => $jobs[0], 'uri' => 'jobs'])
            @endif
        </div>
    </div>
    <div>{{ $jobs->links() }}</div>
</x-app-layout>
