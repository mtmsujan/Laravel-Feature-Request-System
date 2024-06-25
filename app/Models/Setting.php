<?php

namespace App\Models;

use App\Casts\JsonCast;
use App\Casts\UrlCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'logo' => UrlCast::class,
        'favicon' => UrlCast::class,
        'colors' => JsonCast::class,
        'socials' => JsonCast::class,
    ];

    public function getColor(string $type, ?object $default = null): string
    {
        $default = $default == null ? $this->colors->primary : $default;
        $color = $this->colors->{$type} ?? $default;

        return "hsl({$color->h}, {$color->s}%, {$color->l}%)";
    }

    public function getColorLight(string $type, ?object $default = null): string
    {
        $default = $default == null ? $this->colors->primary : $default;
        $color = $this->colors->{$type} ?? $default;
        $l = $color->l + 10;

        return "hsl({$color->h}, {$color->s}%, {$l}%)";
    }

    public function getColorHover(string $type, ?object $default = null): string
    {
        $default = $default == null ? $this->colors->primary : $default;
        $color = $this->colors->{$type} ?? $default;
        $l = $color->l - 10;

        return "hsl({$color->h}, {$color->s}%, {$l}%)";
    }
}
