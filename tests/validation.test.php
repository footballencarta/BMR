<?php

use Footballencarta\BMR\BMR;

class ValidationTest extends \PHPUnit\Framework\TestCase
{
  protected $bmr;

    public function setUp()
    {
      $this->bmr = new BMR();
    }

    public function testAgeTooYoung() {
      $this->expectException(OutOfRangeException::class);

      $this->bmr
        ->age(12);
    }

    public function testInvalidAge() {
      $this->expectException(OutOfRangeException::class);

      $this->bmr
        ->age('twelve');
    }

    public function testGenderError() {
      $this->expectException(OutOfRangeException::class);

      $this->bmr
        ->gender('other');
    }

    public function testInchesError() {
      $this->expectException(OutOfRangeException::class);

      $this->bmr
        ->heightInFeet(1, 27);
    }

    public function testFeetError() {
      $this->expectException(OutOfRangeException::class);

      $this->bmr
        ->heightInFeet(1, 11);
    }

    public function testHeightError() {
      $this->expectException(OutOfRangeException::class);

      $this->bmr
        ->heightInMetres(11, 11);
    }

    public function testMissingCalculateArguments() {
      try {
        $this->bmr
          ->reset()
          ->calculate();
      } catch(\InvalidArgumentException $e) {
        $this->assertEquals($e->getMessage(), 'Age is missing');
      }

      try {
        $this->bmr
          ->reset()
          ->age(55)
          ->calculate();
      } catch(\InvalidArgumentException $e) {
        $this->assertEquals($e->getMessage(), 'Weight is missing');
      }

      try {
        $this->bmr
          ->reset()
          ->age(55)
          ->weightInKg(59)
          ->calculate();
      } catch(\InvalidArgumentException $e) {
        $this->assertEquals($e->getMessage(), 'Height is missing');
      }

      try {
        $this->bmr
          ->reset()
          ->age(55)
          ->weightInKg(59)
          ->heightInFeet(5, 6)
          ->calculate();
      } catch(\InvalidArgumentException $e) {
        $this->assertEquals($e->getMessage(), 'Gender is missing');
      }

      $bmr = $this->bmr
        ->reset()
        ->age(55)
        ->weightInKg(59)
        ->heightInFeet(5, 6)
        ->gender(BMR::FEMALE)
        ->calculate();

      $this->assertEquals($bmr, 1204);
    }
}
