<?php declare(strict_types=1);

namespace Nabeghe\NoHtml\Tests\Fixtures;

use Nabeghe\NoHtml\NoHtml as N;
use Nabeghe\NoHtml\Nodes\Element as El;

class Items
{
    public static function generate(El $el)
    {
        $template = $el->data('template');

        $items = [];
        for ($i = 0; $i < 10; $i++) {
            $n = $i + 1;
            if ($n < 10) {
                $n = '0'.$n;
            }

            $items[] = N::li(str_replace('{n}', "$n", $template));
        }

        return $items;
    }
}