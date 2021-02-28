<?php
require_once "Algorithm.php";

define('MIN_CELLS', 10);
define('MAX_CELLS', 20);
define('MIN_NUMBER', -100);
define('MAX_NUMBER', 100);
define('FIRST_INDEX', 0);

$randomArr = createRandomArr();
define('LAST_INDEX', count($randomArr) - 1);
printArray($randomArr, false);

$start = FIRST_INDEX;
$end = LAST_INDEX;
$algorithm = new Algorithm();
$algorithm->insertionSort($randomArr);
//$algorithm->quickSort($randomArray, $start, $end);

$wantedNum = rand(MIN_NUMBER, MAX_NUMBER);
$idx = $algorithm->binarySearch($randomArr, $wantedNum, 0, count($randomArr) - 1);

printArray($randomArr, true);
if ($idx !== -1) {
    echo 'The number ' . $randomArr[$idx] . " you are looking for has an index $idx.\n";
} else {
    echo 'The searched number ' . $wantedNum . " does not exist in the array!\n";
}

function printArray(array $arr, bool $sorted) : void
{
    echo (!$sorted) ? 'Unsorted array: ' : 'Sorted array:   ';
    foreach ($arr as $key => $value) {
        switch ($key) {
            case FIRST_INDEX:
                echo "[$value, ";
                break;
            case LAST_INDEX:
                echo "$value]";
                break;
            default:
                echo "$value, ";
        }
    }
    echo PHP_EOL;
}

function createRandomArr(): array
{
    $cells = rand(MIN_CELLS, MAX_CELLS);
    $arr = [];

    for ($cell = 0; $cell < $cells; $cell++) {
        $randomValue = rand(MIN_NUMBER, MAX_NUMBER);
        $arr[$cell] = $randomValue;
    }
    return $arr;
}