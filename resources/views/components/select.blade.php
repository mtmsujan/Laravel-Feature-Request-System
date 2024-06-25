@php
    $name = $attributes->get('name');
    $id = $attributes->has('id') ? $attributes->get('id') : uniqid('select-');
@endphp

<div>
    @if ($attributes->has('label'))
        <label for="{{ $id }}" class="label">{!! $attributes->get('label') !!}</label>
    @endif
    <select
        {{ $attributes->class(['input', 'input-primary' => !$errors->has($name), 'input-error' => $errors->has($name)])->merge(['id' => $id]) }}>
        @if ($attributes->has('placeholder'))
            <option selected disabled>{{ $attributes->get('placeholder') }}</option>
        @endif
        @if (count($items) > 0)
            @foreach ($items as $item)
                <option class="capitalize" value="{{ $item['value'] ?? ($item['option'] ?? $item) }}"
                    @selected(($item['value'] ?? ($item['option'] ?? $item)) == old($name) || ($item['value'] ?? ($item['option'] ?? $item)) == $value || ($item['selected'] ?? false))>
                    {{ $item['option'] ?? $item }}</option>
            @endforeach
        @else
            {{ $slot }}
        @endif
    </select>
    @error($name)
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
            {!! $message !!}
        </p>
    @enderror
</div>
