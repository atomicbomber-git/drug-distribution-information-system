<?php


namespace App\GlobalHelpers;


use Jenssegers\Date\Date;

class Formatter
{
    public static function fancyDate($date): string
    {
        return Date::create($date)->format("l, j F Y H:i:s");
    }
}
