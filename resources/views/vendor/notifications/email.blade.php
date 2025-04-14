<x-mail::message>

{{-- Custom Logo --}}
{{-- <x-mail::panel>
    <img src="https://myimgs.org/storage/images/3684/WhatsApp_Image_2025-02-11_at_10.png" alt="AULSH Logo" style="max-width: 200px; margin-bottom: 20px;">
</x-mail::panel> --}}

{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Oups!')
@else
# @lang('Bonjour!')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
<x-mail::button :url="$actionUrl" :color="$color">
{{ $actionText }}
</x-mail::button>
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Merci,')<br>
**L'Agence Urbain de Laâyoune Sakia Al Hamra**
@endif

{{-- Subcopy --}}
@isset($actionText)
<x-slot:subcopy>
@lang(
    "Si vous avez des difficultés à cliquer sur le bouton \":actionText\", copiez et collez l'URL ci-dessous\n".
    'dans votre navigateur web :',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
@endisset
</x-mail::message>
