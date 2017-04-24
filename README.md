[![Build Status](https://travis-ci.org/footballencarta/BMR.svg?branch=master)](https://travis-ci.org/footballencarta/BMR)

# BMR
PHP class to calculate the "Basal Metabolic Rate" using the The Mifflin St Jeor Equation. Supports lb, kg and stone for weight, and feet, inches and cm for height.

# Installation:

The preferred method of installation is via Packagist and Composer. Run the following command to install the package and add it as a requirement to your project's `composer.json`:

```
composer require footballencarta/bmr
```

## Usage

The class is designed to work in a fluent way, so each option needs to be set before calculation

### Get the BMR

```
echo (new Footballencarta\BMR())
	->age(55)
	->gender(BMR::FEMALE)
	->heightInFeet(5, 6)
	->weightInStone(9, 4)
	->calculate();

// Result: 1204
```

## Functions

### Height
For cm (centimeters), use the function `->heightInMetres($metres, $centimetres)`. This does allow metres to be 0 to allow just centimetres to be passed through

For feet & inches, use the function `->heightInFeet($feet, $inches)`. Feet must be between 3 and 9, and inches must be between 0 and 11.

### Weight
For kg (kilograms), use the function `->weightInKg($kg)`.

For lb (pounds), use the function `->weightInLb($lb)`.

For stone & pounds , use the function `->weightInStone($stone, $lb)`. This does allow stone to be 0 to allow just pounds to be passed through

### Gender
Unfortunately, the BMR calculation requires a binary gender.

For compatibility, it's suggested to use the `BMR::MALE` or `BMR::FEMALE` constants.

If you don't want to use the constants, any word beginning with an `m` is flagged as male, and anything with an `f` is flagged as female.

`->gender(BMR::FEMALE)` or `->gender('female')`

### Age
The age must be greater than 18 for the BMR calculation to work.

`->age(55);`

### Calculate function
You can use `->calculate()` to perform the calculation, which will return your BMR value.

You could also use `->getFormattedBmr()` to provide a 2dp number formatted version.

If there are any validation problems, either a `OutOfRangeException` or `InvalidArgumentException` will be thrown
