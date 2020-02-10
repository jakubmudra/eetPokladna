<?php


namespace App\Libs;


class Formater
{
    public static function stockProductDiff($ar1, $ar2)
    {
        $ids = [
            array_column($ar1, "id"),
            array_column($ar2, "id")
            ];

        $diff = array_udiff($ar2, $ar1, 'self::udiffCompare');

        return $diff;

    }

    private static function udiffCompare($a, $b)
    {
        return $a['id'] - $b['id'];
    }


}