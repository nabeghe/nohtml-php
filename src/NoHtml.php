<?php namespace Nabeghe\NoHtml;

use Nabeghe\NoHtml\Nodes\Element;

/**
 * @mixin Ide\NoHtmlMixin
 */
class NoHtml
{
    public function __call($name, $arguments)
    {
        // $name      -> tag or element name
        // $arguments -> childs

        return new Element($name, $arguments ?: null);
    }

    public static function __callStatic($name, $arguments)
    {
        // $name      -> tag or element name
        // $arguments -> childs

        return new Element($name, $arguments ?: null);
    }
}