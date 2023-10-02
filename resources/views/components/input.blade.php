@props(['placeholder','type' => 'text','disabled' => false])

<input
    {{ $disabled ? 'disabled' : '' }} 
    {{ $attributes->merge([
        'type' => $type,
        'placeholder' =>  $placeholder ?? '',
        'class' => 'block w-full mt-1 text-sm rounded-lg focus:ring-accent focus:border-accent focus:shadow-outline-accent focus:outline-none form-input',
    ]) }}
/>

