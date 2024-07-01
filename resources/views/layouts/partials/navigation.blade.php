@php
    if (Auth::user()?->employer) {
        $notifications = Auth::user()->employer->unreadNotifications;
    }

    if (Auth::user()?->jobSeeker) {
        $notifications = Auth::user()->jobSeeker->unreadNotifications;
    }
@endphp
<nav class="bg-gray-800 border-b border-white/10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <a href="/jobs" class="flex-shrink-0 flex flex-row items-center">
                    <x-application-logo class="h-8 w-8" />
                    <div class="my-0">
                        <div class="text-white pl-2 font-bold text-l">{{ config('app.name', 'Job Website') }}</div>
                        @guest
                            @if (Session::get('user_type') === 'Employer')
                                <div class="text-white pl-2 font-extralight italic text-xs">for Employers</div>
                            @elseif(request()->is('login'))
                            @else
                                <div class="text-white pl-2 font-extralight italic text-xs">for Job Seekers</div>
                            @endif
                        @endguest

                        @auth
                            @can('employer')
                                <div class="text-white pl-2 font-extralight italic text-xs">for Employers</div>
                            @endcan
                            @can('jobSeeker')
                                <div class="text-white pl-2 font-extralight italic text-xs">for Job Seekers</div>
                            @endcan
                        @endauth
                    </div>
                </a>
            </div>
            <div class="hidden md:block">
                <div class="ml-3 flex items-center md:ml-6">
                    @auth
                        <!-- Notification dropdown -->
                        <div class="hidden sm:flex sm:items-center sm:ms-1">
                            <x-dropdown align="right" width="96">
                                <x-slot name="trigger">
                                    <button type="button"
                                        class="group mx-3 relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-gray-200">
                                        <span class="absolute -inset-1.5"></span>
                                        <span class="sr-only">View notifications</span>
                                        <div class="relative">
                                            <svg class="h-6 w-6 group-focus:fill-gray-500 group-focus:text-gray-200 stroke-slate-500 group-focus:group-hover:fill-gray-400"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                            </svg>

                                            @if ($notifications->isNotEmpty())
                                                <div
                                                    class="group-hover:bg-red-400 absolute w-4 h-4 bg-red-600 rounded-full text-center text-xs text-white -top-1 -right-1">
                                                    {{ $notifications->count() }}
                                                </div>
                                            @endif
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <div class="ml-2 p-2 text-gray-700">
                                        <form class="flex flex-1 place-content-between content-center" method="POST"
                                            action={{ route('notifications.markAllAsRead') }}>
                                            @csrf
                                            <div class="text-sm font-semibold">
                                                {{ __('Notifications') }}
                                            </div>

                                            @if (!$notifications->isEmpty())
                                                <button class="text-sm text-gray-700/80 mr-2">
                                                    {{ __('Mark all as read') }}
                                                </button>
                                            @endif
                                        </form>
                                    </div>

                                    @if ($notifications)
                                        @if ($notifications->isEmpty())
                                            <div class="text-sm ml-2 p-2 text-gray-700/80">
                                                <div>
                                                    {{ __('You have no notifications') }}
                                                </div>
                                            </div>
                                        @endif
                                        @can('employer')
                                            <div class="overflow-y-scroll max-h-96">
                                                @foreach ($notifications as $notification)
                                                    <form method="POST" action="{{ route('notifications.markAsRead') }}">
                                                        @csrf

                                                        <input type="hidden" value="{{ $notification->id }}"
                                                            name="notification_id" id="notification_id" />
                                                        <input type="hidden"
                                                            value="{{ $notification->data['jobApplication_id'] }}"
                                                            name="jobApplication_id" id="jobApplication_id" />
                                                        <button type="submit"
                                                            class="block w-full border-b px-4 py-2 text-start text-sm leading-5 text-gray-700 bg-gray-300 transition duration-150 ease-in-out hover:bg-gray-200">
                                                            <span class="bold">
                                                                {{ $notification->data['message'] }}
                                                            </span>
                                                        </button>
                                                    </form>
                                                @endforeach
                                            </div>
                                        @endcan
                                    @endif
                                </x-slot>
                            </x-dropdown>
                        </div>
                        <!-- Profile dropdown -->
                        <div class="hidden sm:flex sm:items-center sm:ms-1">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>
                                            @can('jobSeeker')
                                                {{ Auth::user()->jobSeeker->first_name . ' ' . Auth::user()->jobSeeker->last_name }}
                                            @endcan
                                            @can('employer')
                                                {{ Auth::user()->employer->name }}
                                            @endcan
                                        </div>

                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('My Profile') }}
                                    </x-dropdown-link>

                                    @can('jobSeeker')
                                        <x-dropdown-link :href="route('applied-jobs')">
                                            {{ __('Job Applications') }}
                                        </x-dropdown-link>

                                        <x-dropdown-link :href="route('saved-jobs.index')">
                                            {{ __('Saved Jobs') }}
                                        </x-dropdown-link>
                                    @endcan

                                    @can('employer')
                                        <x-dropdown-link :href="route('posted-jobs')">
                                            {{ __('Posted Jobs') }}
                                        </x-dropdown-link>

                                        <x-dropdown-link :href="route('job-applicants')">
                                            {{ __('Job Applicants') }}
                                        </x-dropdown-link>
                                    @endcan

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @endauth
                    @guest
                        <x-nav-link class="mr-3" href="{{ route('login') }}" :active="request()->is('login')">Log In</x-nav-link>
                        <x-nav-link class="mr-3" href="{{ route('register') }}" :active="request()->is('register')">Register</x-nav-link>
                        <form method="POST" action="{{ route('toggleUserTypeView') }}">
                            @csrf

                            @if (Session::get('user_type') === 'Employer')
                                <input type="hidden" name="user_type" id="user_type" value="Job Seeker">
                                <button
                                    class='text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium'>
                                    Job Seeker / Find Jobs
                                </button>
                            @else
                                <input type="hidden" name="user_type" id="user_type" value="Employer">
                                <button
                                    class='text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium'>
                                    Employer / Post Jobs
                                </button>
                            @endif
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</nav>
