<?php namespace Footballencarta\BMR;
/**
 * Calculars a persons BMR (Basal Metabolic Rate)
 */

class BMR
{
  const MALE = 'm';
  const FEMALE = 'f';

    protected $age;

    protected $gender;

    protected $height;

    protected $weight;

    public function reset()
    {
      return new $this();
    }

    // set age
    public function age($age)
    {
        if (!is_int($age) || $age < 18) {
            throw new \OutOfRangeException('Invalid Age');
        }

        $this->age = $age;

        return $this;
    }

    // set gender
    public function gender($gender)
    {
        $gender = strtolower($gender);

        if (strpos($gender, 'f') === 0) { // starts with f, assume Female
          $this->gender = self::FEMALE;

          return $this;
        }

        if (strpos($gender, 'm') === 0) { // starts with m, assume Male
          $this->gender = self::MALE;

          return $this;
        }

        throw new \OutOfRangeException('Gender must be male or female - sorry!');
    }

    public function heightInFeet($feet, $inches)
    {
      if ($inches < 0 || $inches > 11) {
        throw new \OutOfRangeException('Inches must be between 0 and 11');
      }

      // validate feet
      if ($feet < 3 || $feet > 9) {
          throw new \OutOfRangeException('Feet must be between 3 and 9');
      }

      // convert feet to inches and add to $total_inches
      $inches += $feet * 12;

      // convert inches to cm
      return $this->heightInMetres(0, round($inches * 2.54));
    }

    public function heightInMetres($metres, $centimetres)
    {
      $centimetres += ($metres * 100);

      if ($centimetres < 119 || $centimetres > 274) {
          throw new \OutOfRangeException('Invalid height - out of range');
      }

      $this->height = $centimetres;

      return $this;
    }

    public function weightInLb($lbs)
    {
        $kg = round($lbs / 2.2); // 2.2 lb in 1kb

        return $this->weightInKg($kg);
    }

    public function weightInStone($stone, $lbs)
    {
        $lbs += ($stone * 14); // 14 lb in 1 stone

        return $this->weightInLb($lbs);
    }

    public function weightInKg($kg)
    {
        $this->weight = $kg;

        return $this;
    }

    // calculate BMR
    public function calculate()
    {
        // validate parameters
        if (!$this->age) {
          throw new \InvalidArgumentException('Age is missing');
        }

        if (!$this->weight) {
            throw new \InvalidArgumentException('Weight is missing');
        }

        if (!$this->height) {
            throw new \InvalidArgumentException('Height is missing');
        }

        if (!$this->gender) {
            throw new \InvalidArgumentException('Gender is missing');
        }

        $bmr = (10 * $this->weight) + (6.25 * $this->height) - (5 * $this->age);

        if ($this->gender == self::FEMALE) {
          return $bmr - 161;
        }

        return $bmr + 5;
    }

    // get BMR
    public function getFormattedBmr()
    {
        // return BMR fixed to two decimals
        // if you pass refresh in $options it will calculate first
        return number_format($this->calculate(), 2, '.', '');
    }
}
