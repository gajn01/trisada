@props(['name'])

<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => '
            block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150
            bg-cta border-transparent rounded-lg active:opacity-80 hover:opacity-80 focus:outline-none',
    ]) }}>
    {{ $name ?? $slot }}
</button>


