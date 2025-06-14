<?php declare(strict_types=1);

namespace Nabeghe\NoHtml\Tests\Fixtures;

use Nabeghe\NoHtml\Nodes\Element as El;

class Css
{
    public static function tableRow(string $name, El $el)
    {
        return 'hover:bg-gray-100';
    }

    public static function tableCell(string $name, El $el)
    {
        return 'border border-gray-300 px-4 py-2';
    }
}