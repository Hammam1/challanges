<?php

function SearchingChallenge(array $strArr)
{
    // code goes here
    $d2Array = construct2DArray($strArr);
    return count2DArrayHoles($d2Array);
}

function count2DArrayHoles(array $d2Array)
{
    $holes = 0;
    $stringWithholes = [];
    foreach ($d2Array as $key => $value) {
        $rowStr = implode($value);
        $colStr = implode(array_column($d2Array, $key));
        $revRowStr = strrev($rowStr);
        $revColStr = strrev($colStr);
        $holes += countNumberOfHolesInString($rowStr, $stringWithholes);
        $holes += countNumberOfHolesInString($rowStr, $stringWithholes);
        $holes += countNumberOfHolesInString($revRowStr, $stringWithholes);
        $holes += countNumberOfHolesInString($revColStr, $stringWithholes);
    }
    return $holes;
}

function countNumberOfHolesInString(string $str, array &$stringWithholes)
{
    if (!in_array($str, $stringWithholes)) {
        $holes = 0;
        $startIndex = 0;
        do {
            $startOneIndex = strpos($str, "1", $startIndex);
            $zeroIndex = strpos($str, "0", $startOneIndex);
            $nextOneIndex = strpos($str, "1", $zeroIndex);
            if ($zeroIndex > $startOneIndex && $zeroIndex < $nextOneIndex) {
                $holes += 1;
                $startIndex = $nextOneIndex;
            } else {
                $startIndex = 0;
            }
        } while ($startIndex != 0 && $startIndex + 1 != strlen($str));
        if($holes) {
            array_push($stringWithholes, $str);
        }
        return $holes;
    }
}

function construct2DArray(array $d1Matrix)
{
    $d2Matrix = [];
    foreach ($d1Matrix as $key => $value) {
        $d2Matrix[$key] = str_split($value);
    }
    return $d2Matrix;
}

    
