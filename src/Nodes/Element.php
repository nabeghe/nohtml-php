<?php namespace Nabeghe\NoHtml\Nodes;

use InvalidArgumentException;
use Nabeghe\NoHtml\Helpers\ElementMap;
use Nabeghe\NoHtml\Helpers\Escape;

/**
 * @mixin \Nabeghe\NoHtml\Ide\Elements\MainElement
 */
class Element
{
    protected string $name = 'div';

    public ?array $childs = null;

    public array $attrs = [];

    public function __construct(string $name, ?array $childs = null, array $attrs = [])
    {
        if (!preg_match('/^[a-z][a-z0-9-]*$/i', $name)) {
            throw new InvalidArgumentException("Invalid tag name: $name");
        }

        $this->name = $name;
        $this->childs = $childs;
        $this->attrs = $attrs;

        //if ($childs && isset(self::VOID_ELEMENTS[$this->name])) {
        //    $childs = null;
        //}
    }

    public function __get(string $name)
    {
        return $this->attrs[$name] ?? null;
    }

    public function __call(string $name, array $arguments)
    {
        if ($arguments) {
            $this->attrs[$name] = $arguments[0];
            return $this;
        }

        return $this->attrs[$name] ?? null;
    }

    public function __toString(): string
    {
        $element = '<'.$this->name;

        if ($this->attrs) {
            foreach ($this->attrs as $name => $value) {
                if ($value === null) {
                    continue;
                }

                if (is_bool($value)) {
                    if ($value) {
                        $element .= ' '.$name;
                    }
                } elseif (!is_string($value) && is_callable($value)) {
                    $value_output = $value($name, $this);
                    if (!is_null($value_output)) {
                        $element .= ' '.$name.'="'.Escape::attr($value($name, $this)).'"';
                    }
                } else {
                    $element .= ' '.$name.'="'.Escape::attr($value).'"';
                }
            }
        }

        if (ElementMap::isVoidElement($this->name)) {
            $element .= ' />';
            return $element;
        }

        $element .= '>';

        if ($this->childs) {
            foreach ($this->childs as $child) {
                if (is_string($child)) {
                    $element .= Escape::html($child);
                } elseif (is_callable($child)) {
                    $child_output = $child($this);
                    if (is_array($child_output)) {
                        foreach ($child_output as $child2) {
                            $element .= $child2;
                        }
                    } else {
                        $element .= $child;
                    }
                } else {
                    $element .= $child;
                }
            }
        }

        $element .= '</'.$this->name.'>';

        return $element;
    }

    /**
     * @param  string  $key
     * @param $value
     * @return $this|mixed|null
     */
    public function aria(string $key, $value = null)
    {
        if (func_num_args() == 2) {
            $this->attrs['aria-'.$key] = $value;
            return $this;
        }

        return $this->attrs['aria-'.$key] ?? null;
    }

    /**
     * @param  string  $key
     * @param $value
     * @return $this|mixed|null
     */
    public function data(string $key, $value = null)
    {
        if (func_num_args() == 2) {
            $this->attrs['data-'.$key] = $value;
            return $this;
        }

        return $this->attrs['data-'.$key] ?? null;
    }
}