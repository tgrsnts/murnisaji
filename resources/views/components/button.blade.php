@props([
    'text' => null,
    'variant' => 'full',
    'type' => 'button',
    'tone' => 'primary',
])

@php
    $radiusClass = $variant === 'lg' ? 'rounded-lg' : 'rounded-full';

    $toneClass = $tone === 'secondary'
        ? 'border-2 border-[#7A1F1F] text-[#7A1F1F] hover:bg-[#7A1F1F] hover:text-white transition duration-300'
        : 'bg-[#7A1F1F] hover:bg-[#5a1717] text-white';
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => "px-8 py-3 {$radiusClass} {$toneClass}"]) }}>
    {{ $text ?? $slot }}
</button>