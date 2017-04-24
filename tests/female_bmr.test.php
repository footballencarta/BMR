<?php

use Footballencarta\BMR\BMR;

class FemaleBmrTest extends \PHPUnit\Framework\TestCase
{
  protected $bmr;

    public function setUp()
    {
      $this->bmr = new BMR();
    }

    public function testCalculateFeetStone() {
      $bmr = $this->bmr
        ->age(55)
        ->gender(BMR::FEMALE)
        ->heightInFeet(5, 6)
        ->weightInStone(9, 4)
        ->calculate();

        $this->assertEquals($bmr, 1204);
    }

    public function testCalculateFeetLb() {
      $bmr = $this->bmr
        ->age(55)
        ->gender(BMR::FEMALE)
        ->heightInFeet(5, 6)
        ->weightInLb(130)
        ->calculate();

        $this->assertEquals($bmr, 1204);
    }

    public function testCalculateFeetKg() {
      $bmr = $this->bmr
        ->age(55)
        ->gender(BMR::FEMALE)
        ->heightInFeet(5, 6)
        ->weightInKg(59)
        ->calculate();

        $this->assertEquals($bmr, 1204);
    }

    public function testCalculateCMKg() {
      $bmr = $this->bmr
        ->age(55)
        ->gender(BMR::FEMALE)
        ->heightInMetres(1, 68)
        ->weightInKg(59)
        ->calculate();

        $this->assertEquals($bmr, 1204);
    }

    public function testFormattedBmr() {
      $bmr = $this->bmr
        ->age(55)
        ->gender(BMR::FEMALE)
        ->heightInMetres(1, 68)
        ->weightInKg(59)
        ->getFormattedBmr();

        $this->assertEquals($bmr, '1204.00');
    }
}
