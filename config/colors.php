<?php

/**
 * @var object $white the default color value for `header_text`.
 *
 * Also serves as an example of default color.
 */
$white = (object) ['h' => 0, 's' => 100, 'l' => 100];

/**
 * This is key value pair of colors that are used in application.
 * The key is used as database column and css variable as `--color-key` or `--color-key-variant` etc
 * The value is used as the default value if there is no color found with this column in the database.
 * It will take the primary color as default so you must give it a value of null or a valid object of hsl color options
 * like `$white`
 * 
 * *Use php artisan colors:generate after adding a new color*
 */
return [
    'primary' => null,
    // 'secondary' => null,
    'header_bg' => null,
    'header_text' => $white,
];
