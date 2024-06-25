<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * Stores an image given an image request and a directory
 *
 * @param  string  $old_path
 * @param  string  $prefix  skip if you need clientOriginalName
 * @param  string  $disk  default = public
 * @return string $new_path
 */
function saveFile(UploadedFile $file, string $dir, ?string $prefix = '', string $disk = 'public')
{
    if ($file) {
        if ($prefix === '' || $prefix === null) {
            $prefix = Str::slug($file->getClientOriginalName());
        }
        $ext = $file->extension();
        $name = $prefix.'-'.now()->timestamp.'.'.$ext;
        $path = $file->storeAs("uploads/$dir", $name, $disk);

        return $path;
    } else {
        return $file;
    }
}

function userEmail()
{
    return request()->user()?->email;
}

function avatar(?string $seed = null)
{
    if ($seed) {
        $seed = Str::slug($seed);
    } else {
        $seed = Str::random();

        return "https://api.dicebear.com/7.x/bottts-neutral/svg?seed=$seed&radius=50";
    }

    return "https://api.dicebear.com/7.x/initials/svg?seed=$seed&radius=50";
}

/**
 * Convert Hex Colors into HSL color
 *
 * @param  string  $hex
 * @return mixed
 */
function hex2hsl($hex)
{
    // Remove '#' if present
    $hex = str_replace('#', '', $hex);

    // Convert hex to RGB
    $r = hexdec(substr($hex, 0, 2)) / 255;
    $g = hexdec(substr($hex, 2, 2)) / 255;
    $b = hexdec(substr($hex, 4, 2)) / 255;

    // Find min and max values
    $min = min($r, $g, $b);
    $max = max($r, $g, $b);

    // Calculate lightness
    $l = ($max + $min) / 2;

    // If the colors are the same, we have a shade of grey
    if ($max == $min) {
        $h = $s = 0; // Hue and Saturation will be 0
    } else {
        $d = $max - $min;

        // Calculate Saturation
        $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);

        // Calculate Hue
        switch ($max) {
            case $r:
                $h = 60 * (($g - $b) / $d + ($g < $b ? 6 : 0));
                break;
            case $g:
                $h = 60 * (($b - $r) / $d + 2);
                break;
            case $b:
                $h = 60 * (($r - $g) / $d + 4);
                break;
        }
    }

    return [
        'h' => round($h),
        's' => round($s * 100),
        'l' => round($l * 100),
    ];
}

/**
 * Convert HSL values into HEX color
 *
 * @param  int  $h
 * @param  int  $s
 * @param  int  $l
 * @return mixed
 */
function hsl2hex($h, $s, $l)
{
    $h /= 360;
    $s /= 100;
    $l /= 100;

    if ($s == 0) {
        $r = $g = $b = $l * 255;
    } else {
        $hue2rgb = function ($p, $q, $t) {
            if ($t < 0) {
                $t += 1;
            }
            if ($t > 1) {
                $t -= 1;
            }
            if ($t < 1 / 6) {
                return $p + ($q - $p) * 6 * $t;
            }
            if ($t < 1 / 2) {
                return $q;
            }
            if ($t < 2 / 3) {
                return $p + ($q - $p) * (2 / 3 - $t) * 6;
            }

            return $p;
        };

        $q = $l < 0.5 ? $l * (1 + $s) : $l + $s - $l * $s;
        $p = 2 * $l - $q;
        $r = $hue2rgb($p, $q, $h + 1 / 3) * 255;
        $g = $hue2rgb($p, $q, $h) * 255;
        $b = $hue2rgb($p, $q, $h - 1 / 3) * 255;
    }

    return '#'.sprintf('%02x%02x%02x', round($r), round($g), round($b));
}

/**
 * Returns color that are used in application
 *
 * @return object
 */
function appColor(string $type, ?object $default = null)
{
    $default = $default == null ? app('settings')->colors->primary : $default;
    $color = app('settings')->colors->{$type} ?? $default;

    return (object) [
        'name' => $type,
        'label' => $type.'_color',
        'value' => hsl2hex($color->h, $color->s, $color->l),
    ];
}

/**
 * Returns colors that are used in application
 *
 * @return object
 */
function getAppColors()
{
    $colorNames = getColorNames();
    foreach ($colorNames as $colorName => $default) {
        $colors[] = appColor($colorName, $default);
    }

    return $colors;
}

/**
 * Return the name of the colors. This is where you should add new color name
 *
 * @return array
 */
function getColorNames()
{
    return config('colors');
}
