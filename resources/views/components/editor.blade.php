@php
    $name = $attributes->get('name');
    $id = $attributes->has('id') ? $attributes->get('name') : uniqid('editor-');

@endphp
@pushOnce('styles')
    <style>
        .fr-wrapper>div:first-child {
            display: none !important;
        }

        .fr-floating-btn {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }
        #fr-logo{
            display: none !important;
        }
    </style>
@endPushOnce

@if ($attributes->has('label'))
    <label for="{{ $id }}">{!! $attributes->get('label') !!}</label>
@endif
<textarea {{ $attributes->class('editor')->merge(['id' => $id]) }}>{!! $slot->isNotEmpty() ? $slot : old($name) !!}</textarea>
@error($name)
    <div class="text-red-500">
        {{ $message }}
    </div>
@enderror
