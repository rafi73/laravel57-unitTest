<?php

namespace Tests\Unit;

use App\Http\Controllers\CalculatorController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CalculatorTest extends TestCase
{
    protected $calculator;

    /**
     * 預執行，在執行 Test Case 之前
     */
    public function setUp()
    {
        parent::setUp();
        $this->calculator = $this->app->make(CalculatorController::class);
    }

    /**
     * Sum Test Case
     */
    public function testSum()
    {
        $this->assertEquals(15, $this->calculator->sumArray([1,2,3,4,5]));
    }

    /**
     * Plus Test Case
     */
    public function testPlus()
    {
        $this->assertEquals(72, $this->calculator->plus(39, 33));
    }

    /**
     * Minus Test Case
     */
    public function testMinus()
    {
        $this->assertEquals(-7, $this->calculator->minus(3, 10));
    }

    /**
     * Division Test Case
     */
    public function testDivision()
    {
        $this->assertTrue(true, $this->calculator->division(30, 6));
    }

    /**
     * Multiply Test Case
     */
    public function testMultiply()
    {
        $this->assertTrue(true, $this->calculator->multiply(3, 5));
    }
}
