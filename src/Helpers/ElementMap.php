<?php namespace Nabeghe\NoHtml\Helpers;

class ElementMap
{
    const VOID_ELEMENTS = [
        'area' => true,
        'base' => true,
        'br' => true,
        'col' => true,
        'embed' => true,
        'hr' => true,
        'img' => true,
        'input' => true,
        'link' => true,
        'meta' => true,
        'source' => true,
        'track' => true,
        'wbr' => true,
    ];

    public static function isVoidElement(string $name): bool
    {
        return isset(self::VOID_ELEMENTS[$name]);
    }
}