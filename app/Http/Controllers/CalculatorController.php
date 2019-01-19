<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @param array $array
     *
     * @return float|int
     */
    public function sumArray(array $array)
    {
        return array_sum($array);
    }

    /**
     * @param $numberA
     * @param $numberB
     *
     * @return mixed
     */
    public function plus($numberA, $numberB)
    {
        return $numberA + $numberB;
    }

    /**
     * @param $numberA
     * @param $numberB
     *
     * @return mixed
     */
    public function minus($numberA, $numberB)
    {
        return $numberA - $numberB;
    }

    /**
     * @param $numberA
     * @param $numberB
     *
     * @return float|int
     */
    public function division($numberA, $numberB)
    {
        return $numberA / $numberB;
    }

    /**
     * @param $numberA
     * @param $numberB
     *
     * @return float|int
     */
    public function multiply($numberA, $numberB)
    {
        return $numberA * $numberB;
    }
}
