<style>
    :root {
    @foreach (getColorNames() as $colorName => $default)
    --color-{{ $colorName }}: {{ app('settings')->getColor($colorName, $default) }};
    --color-{{ $colorName }}-light: {{ app('settings')->getColorLight($colorName, $default) }};
    --color-{{ $colorName }}-hover: {{ app('settings')->getColorHover($colorName, $default) }};
    @endforeach
    }
</style>
