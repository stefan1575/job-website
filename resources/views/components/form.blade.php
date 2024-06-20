<form
    {{ $attributes([
        'class' =>
            'mx-auto w-96 sm:max-w-md mt-6 px-6 py-4 bg-white border rounded-lg border-black/10 shadow-md overflow-hidden sm:rounded-lg',
        'method' => 'GET',
    ]) }}>
    <div>
        @if (isset($header))
            <h2 class="text-black text-2xl font-semibold tracking-tight">
                {{ $header }}
            </h2>
            <x-separator />
        @endif
        @if ($attributes->get('method', 'GET') !== 'GET')
            @csrf
            @method($attributes->get('method'))
        @endif
        <div>
            {{ $slot }}
        </div>
    </div>
</form>
