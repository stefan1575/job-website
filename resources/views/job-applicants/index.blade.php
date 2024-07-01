<x-app-layout>
    <x-slot name="header">
        {{ __('Recieved Job Applications') }}
    </x-slot>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Position
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Candidate Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
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
                        $jobSeeker = $jobApplication->jobSeeker;
                        $job = $jobApplication->job;
                        $isFlashed = (int) session('status') === $jobApplication->id;
                    @endphp
                    <tr
                        class="{{ $isFlashed ? 'bg-gray-900/20' : 'odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700' }}  border-b">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $job['title'] }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $jobSeeker->first_name . ' ' . $jobSeeker->last_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $jobSeeker->user->email }}
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
    <div class="mt-8">{{ $jobApplications->links() }}</div>
</x-app-layout>
