<x-app-layout>
    <x-slot name="header">
        {{ __('Applied Jobs') }}
    </x-slot>
    @if ($jobApplications->isEmpty())
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        You haven't applied to any jobs yet. Click <a class="text-blue-500" href="/jobs/">here</a> to
                        start applying.
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Position
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Employer Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Resume
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cover Letter
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Application Date
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($jobApplications as $jobApplication)
                        @php
                            $job = $jobApplication->job;
                        @endphp
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $job['title'] }}
                            </th>
                            <td class="px-6 py-4">

                                {{ $job->employer->name }}
                            </td>

                            <td class="px-6 py-4">
                                <a href="{{ $jobApplication->resume }}" class="cursor-pointer">
                                    <div
                                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" />
                                        </svg>
                                        <span>Download</span>
                                    </div>
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                @if ($jobApplication->cover_letter)
                                    <a href="{{ $jobApplication->cover_letter }}" class="cursor-pointer">
                                        <div
                                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" />
                                            </svg>
                                            <span>Download</span>
                                        </div>
                                    </a>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ $jobApplication->created_at }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-app-layout>
