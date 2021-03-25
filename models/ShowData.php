<?php
namespace App\models;

class ShowData
{
    public static function showDate($data, $format = 'd.m.Y')
    {
        return date($format, strtotime($data));
    }

    public static function showText($data, $length = 100, $symbols = '...')
    {
        return mb_substr($data, 0, $length) . $symbols;
    }
}

//public static function show($data)
//{
//    echo '<hr><pre>';
//    var_dump($data);
//    echo '</pre><hr>';
//}