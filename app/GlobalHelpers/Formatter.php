<?php


namespace App\GlobalHelpers;


use Jenssegers\Date\Date;

class Formatter
{
    public static function fancyDatetime($date): string
    {
        return (new Date($date))->format("l, d F Y H:i:s");
    }

    public static function fancyDate($date): string
    {
        return (new Date($date))->format("l, d F Y");
    }

    public static function currency($amount): string
    {
        return number_format($amount);
    }

    public static function quantity($amount): string
    {
        return number_format($amount);
    }
}
