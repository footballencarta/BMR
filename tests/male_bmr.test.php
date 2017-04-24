<?php

use Footballencarta\BMR\BMR;

class MaleBmrTest extends \PHPUnit\Framework\TestCase
{
  protected $bmr;

    public function setUp()
    {
      $this->bmr = new BMR();
    }

    public function testCalculateFeetStone() {
      $bmr = $this->bmr
        ->age(55)
        ->gender(BMR::MALE)
        ->heightInFeet(5, 6)
        ->weightInStone(9, 4)
        ->calculate();

        $this->assertEquals($bmr, 1370);
    }

    public function testCalculateFeetLb() {
      $bmr = $this->bmr
        ->age(55)
        ->gender(BMR::MALE)
        ->heightInFeet(5, 6)
        ->weightInLb(130)
        ->calculate();

        $this->assertEquals($bmr, 1370);
    }

    public function testCalculateFeetKg() {
      $bmr = $this->bmr
        ->age(55)
        ->gender(BMR::MALE)
        ->heightInFeet(5, 6)
        ->weightInKg(59)
        ->calculate();

        $this->assertEquals($bmr, 1370);
    }

    public function testCalculateCMKg() {
      $bmr = $this->bmr
        ->age(55)
        ->gender(BMR::MALE)
        ->heightInMetres(1, 68)
        ->weightInKg(59)
        ->calculate();

        $this->assertEquals($bmr, 1370);
    }

    public function testFormattedBmr() {
      $bmr = $this->bmr
        ->age(55)
        ->gender(BMR::MALE)
        ->heightInMetres(1, 68)
        ->weightInKg(59)
        ->getFormattedBmr();

        $this->assertEquals($bmr, '1370.00');
    }
}
