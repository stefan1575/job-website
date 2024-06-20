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
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-3 flex items-center md:ml-6">
                    @auth
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

                                    @can('employer')
                                        <x-dropdown-link :href="route('posted-jobs')">
                                            {{ __('Posted Jobs') }}
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
