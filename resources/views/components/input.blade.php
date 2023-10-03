@props(['placeholder','type' => 'text','disabled' => false])

<input
    {{ $disabled ? 'disabled' : '' }} 
    {{ $attributes->merge([
        'type' => $type,
        'placeholder' =>  $placeholder ?? '',
        'class' => 'block w-full mt-1 text-sm rounded-lg focus:ring-secondary focus:border-secondary focus:shadow-outline-secondary focus:outline-none form-input',
    ]) }}
/>

