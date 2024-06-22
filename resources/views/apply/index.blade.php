@props(['job' => $job])

<x-app-layout>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Applying for') }}
                        </p>
                        <h2 class="text-black text-3xl font-semibold tracking-tight">
                            {{ $job['title'] }}
                        </h2>
                        <p class="mt-1 text-m text-gray-600">
                            {{ $job->employer->name }}
                        </p>
                    </header>

                    <form method="post" action="{{ route('apply.store') }}" class="mt-6 space-y-6"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="job_id" id="job_id" value="{{ $job['id'] }}" />
                        <div class="border-b border-black/10"></div>
                        <div class="mt-4">
                            <x-input-label class="text-lg font-semibold" for="resume" :value="__('Resume')" />
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Upload your resume detailing your background, skills, and accomplishments. ') }}
                            </p>
                            <input type="file" id="resume" name="resume"
                                class="mt-4 block w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-gray-50 focus:outline-none"
                                type="file" accept=".pdf" required />
                            <x-input-error :messages="$errors->get('resume')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label class="text-l font-semibold" for="cover_letter" :value="__('Cover Letter (Optional)')" />
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Introduce yourself and briefly explain why you are suitable for this role. Consider your relevant skills, qualifications and related experience.') }}
                            </p>
                            <input type="file" id="cover_letter" name="cover_letter"
                                class="mt-4 block w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-gray-50 focus:outline-none"
                                type="file" accept=".pdf" />
                            <x-input-error :messages="$errors->get('cover_letter')" class="mt-2" />
                        </div>

                        <div class="border-b border-black/10"></div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Submit') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
