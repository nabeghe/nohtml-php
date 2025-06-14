<?php

use Nabeghe\NoHtml\NoHtml;

if (!function_exists('nohtml')) {
    function nohtml(): NoHtml
    {
        if (!isset($GLOBALS['nohtml'])) {
            $GLOBALS['nohtml'] = new NoHtml();
        }

        return $GLOBALS['nohtml'];
    }
}