<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Employer Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your employer's profile information and logo.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update.employer') }}" class="mt-6 space-y-6"
        enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Employer Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->employer->name)" required
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="mt-4">
            <x-input-label for="logo" :value="__('Employer Logo')" />
            <input type="file" id="logo" name="logo"
                class="mt-4 block w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-gray-50 focus:outline-none"
                type="file" accept=".png,.jpg,.jpeg" />
            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'employer-profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
