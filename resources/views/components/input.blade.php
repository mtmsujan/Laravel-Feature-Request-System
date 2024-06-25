@php
    $name = $attributes->get('name');
    $id = $attributes->has('id') ? $attributes->get('id') : uniqid('input-');
@endphp

<div>
    @if ($attributes->has('label'))
        <label for="{{ $id }}" class="label">{!! $attributes->get('label') !!}</label>
    @endif
    <input {{ $attributes->class(['input', 'input-primary' => !$errors->has($name), 'input-error'=> $errors->has($name)])->merge(['id' => $id]) }} />
    @error($name)
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
            {!!$message!!}
        </p>
    @enderror
</div>
