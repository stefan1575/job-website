@props(['job' => $job])
<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Job: ' . $job->title) }}
    </x-slot>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Edit Job') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('We just need a handful of details from you.') }}
                        </p>
                    </header>

                    <form method="post" action="{{ route('job.update', $job) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                required autofocus :value="$job->title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" type="text" class="rounded mt-1 block w-full" required autofocus>{{ $job->description }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="salary" :value="__('Salary')" />
                            <x-text-input id="salary" name="salary" type="text" class="mt-1 block w-full"
                                required autofocus :value="$job->salary" />
                            <x-input-error class="mt-2" :messages="$errors->get('salary')" />
                        </div>

                        <div>
                            <x-input-label for="location" :value="__('Location')" />
                            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full"
                                required autofocus :value="$job->location" />
                            <x-input-error class="mt-2" :messages="$errors->get('location')" />
                        </div>

                        <div>
                            <x-input-label for="schedule" :value="__('Schedule')" />
                            <select name="schedule" id="schedule" class="border-gray-300 mt-1 block w-full rounded">
                                <option value="Full Time">Full Time</option>

                                @if ($job->schedule === 'Part Time')
                                    <option value="Part Time" selected>Part Time</option>
                                @else
                                    <option value="Part Time">Part Time</option>
                                @endif
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('schedule')" />
                        </div>

                        <div class="mt-6 flex items-center justify-between gap-x-6">
                            <div class="flex items-center">
                                <button form="delete-form" class="text-red-500 text-sm font-bold">Delete</button>
                            </div>
                            <div class="flex items-center gap-x-6">
                                <a href="/jobs/{{ $job->id }}"
                                    class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                                <div>
                                    <button type="submit"
                                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <form id="delete-form" method="post" action="{{ route('job.destroy', $job) }}" class="hidden">
                        @csrf
                        @method('delete')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
