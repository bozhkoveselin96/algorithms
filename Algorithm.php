<?php

class Algorithm
{
    public function binarySearch(array $sortedArr, int $wantedNum, int $start, int $end) : int
    {
        if ($start > $end) {
            return -1;
        }
        $middleIdx = intval(($start + $end) / 2);
        if ($wantedNum == $sortedArr[$middleIdx]) {
            return $middleIdx;
        } elseif ($wantedNum < $sortedArr[$middleIdx]) {
            return $this->binarySearch($sortedArr,$wantedNum, $start, $middleIdx - 1);
        } else {
            return $this->binarySearch($sortedArr, $wantedNum,$middleIdx + 1,$end);
        }
    }

    public function bubbleSort(array &$unsortedArr) : void
    {
        for ($times = 0; $times < count($unsortedArr); $times++) {
            $swaps = 0;
            for ($key = 0; $key < count($unsortedArr) - 1; $key++) {
                if ($unsortedArr[$key] > $unsortedArr[$key + 1]) {
                    $temp = $unsortedArr[$key];
                    $unsortedArr[$key] = $unsortedArr[$key + 1];
                    $unsortedArr[$key + 1] = $temp;
                    $swaps++;
                }
            }
            if ($swaps == 0) {
                return;
            }
        }
    }

    public function insertionSort(&$unsortedArr)
    {
        for ($times = 1; $times < count($unsortedArr); $times++) {
            for ($currentIdx = $times; $currentIdx > 0; $currentIdx--) {
                if ($unsortedArr[$currentIdx] < $unsortedArr[$currentIdx - 1]) {
                    $temp = $unsortedArr[$currentIdx];
                    $unsortedArr[$currentIdx] = $unsortedArr[$currentIdx - 1];
                    $unsortedArr[$currentIdx - 1] = $temp;
                }
            }
        }
    }

    public function selectionSort(array &$unsortedArr) : void
    {
        for ($times = 0; $times < count($unsortedArr) / 2; $times++) {
            $min = $unsortedArr[$times];
            $minIdx = $times;
            $max = $unsortedArr[$times];
            $maxIdx = $times;
            for ($key = $times + 1; $key < count($unsortedArr) - $times; $key++) {
                if ($unsortedArr[$key] < $min) {
                    $min = $unsortedArr[$key];
                    $minIdx = $key;
                }
                if ($unsortedArr[$key] > $max) {
                    $max = $unsortedArr[$key];
                    $maxIdx = $key;
                }
            }
            $temp = $unsortedArr[$times];
            $unsortedArr[$times] = $unsortedArr[$minIdx];
            $unsortedArr[$minIdx] = $temp;

            $lastIdx = count($unsortedArr) - 1 - $times;
            if ($unsortedArr[$minIdx] == $max) {
                $temp = $unsortedArr[$lastIdx];
                $unsortedArr[$lastIdx] = $unsortedArr[$minIdx];
                $unsortedArr[$minIdx] = $temp;
            } else {
                $temp = $unsortedArr[$lastIdx];
                $unsortedArr[$lastIdx] = $unsortedArr[$maxIdx];
                $unsortedArr[$maxIdx] = $temp;
            }
        }
    }

    public function countingSort(array &$unsortedArr) : void
    {
        $min = $unsortedArr[0];
        $max = $unsortedArr[0];

        for ($search = 1; $search < count($unsortedArr); $search++) {
            if ($unsortedArr[$search] < $min) {
                $min = $unsortedArr[$search];
            }
            if ($unsortedArr[$search] > $max) {
                $max = $unsortedArr[$search];
            }
        }

        $helper = [];
        for ($keyHelper = $min; $keyHelper <= $max; $keyHelper++) {
            $helper[$keyHelper] = 0;
        }

        foreach ($unsortedArr as $item) {
            $helper[$item]++;
        }

        $nextKey = 0;
        foreach ($helper as $key => $value) {
            for ($times = 0; $times < $value; $times++) {
                $unsortedArr[$nextKey] = $key;
                $nextKey++;
            }
        }
    }

    public function quickSort(array &$unsortedArray, int $start, int $end) : void
    {
        if ($start >= $end) {
            return;
        }
        $pivotIndex = $this->partition($unsortedArray, $start, $end);
        $this->quickSort($unsortedArray,$start,$pivotIndex - 1);
        $this->quickSort($unsortedArray,$pivotIndex + 1, $end);
    }

    private function partition(array &$unsortedPart, int $start, int $end) : int
    {
        $pivot = $unsortedPart[$end];
        $leftmostIdx = $start;

        for ($key = $start; $key < $end; $key++) {
            if ($unsortedPart[$key] <= $pivot) {
                $temp = $unsortedPart[$leftmostIdx];
                $unsortedPart[$leftmostIdx] = $unsortedPart[$key];
                $unsortedPart[$key] = $temp;
                $leftmostIdx++;
            }
        }
        $temp = $unsortedPart[$leftmostIdx];
        $unsortedPart[$leftmostIdx] = $unsortedPart[$end];
        $unsortedPart[$end] = $temp;

        return $leftmostIdx;
    }
}
