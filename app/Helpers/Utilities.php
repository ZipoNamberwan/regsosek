<?php

namespace App\Helpers;

class Utilities
{
    public static function getSentenceFromArray($array, $separator = ', ', $lastseparator = ' dan ')
    {
        $last  = array_slice($array, -1);
        $first = join($separator, array_slice($array, 0, -1));
        $both  = array_filter(array_merge(array($first), $last), 'strlen');
        return join($lastseparator, $both);
    }

    public static function excelColumnJumpByNumber(int $columnIndex, int $jumpBy): string
    {
        $columnIndex += $jumpBy;
        $columnName = '';
        while ($columnIndex > 0) {
            $modulo = ($columnIndex - 1) % 26;
            $columnName = chr(65 + $modulo) . $columnName;
            $columnIndex = (int)(($columnIndex - $modulo) / 26);
        }
        return $columnName;
    }
}
