<?php

namespace Cinam\NumberRanger;

class Ranger
{

    const BREAK_VALUE = '...';

    private $min;
    private $max;

    public function __construct($min, $max, $size)
    {
        $this->min = $min;
        $this->max = $max;
        $this->size = $size;
    }

    public function getRangeWithBoundaries($current)
    {
        $numbers = [$current];

        for ($number = $current - 1; $number >= $this->min && abs($current - $number) <= $this->size; $number--) {
            array_unshift($numbers, $number);
        }

        for ($number = $current + 1; $number <= $this->max && abs($current - $number) <= $this->size; $number++) {
            $numbers[] = $number;
        }

        if ($numbers[0] > $this->min + 1) {
            array_unshift($numbers, self::BREAK_VALUE);
            array_unshift($numbers, $this->min);
        } elseif ($numbers[0] > $this->min) {
            array_unshift($numbers, $this->min);
        }

        $lastIndex = count($numbers) - 1;
        if ($numbers[$lastIndex] < $this->max - 1) {
            $numbers[] = self::BREAK_VALUE;
            $numbers[] = $this->max;
        } elseif ($numbers[$lastIndex] < $this->max) {
            $numbers[] = $this->max;
        }

        return $numbers;
    }
}
