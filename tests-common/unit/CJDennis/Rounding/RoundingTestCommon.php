<?php /** @noinspection PhpUnused */
namespace CJDennis\Rounding;

use SebastianBergmann\Comparator\Factory as ComparatorFactory;

trait RoundingTestCommon {
  protected function _before() {
    ComparatorFactory::getInstance()->reset();
    ComparatorFactory::getInstance()->register(new FloatComparator);
  }

  protected function _after() {
  }

  public static function assertIdentical($expected, $actual, float $delta = 0.0, string $message = '') {
    if ($expected === 0.0 && $actual === 0.0) {
      static::assertSame((string)$expected, (string)$actual, $message);
    }
    else {
      static::assertEqualsWithDelta($expected, $actual, $delta, $message);
    }
  }

  // tests
  public function testShouldRoundTheFractionalPartOfANumberBelowAHalfDownToTheNextInteger() {
    $this->assertIdentical(1.0, Rounding::round(1.499999));
  }

  public function testShouldRoundTheFractionalPartOfANumberExactlyAHalfUpToTheNextInteger() {
    $this->assertIdentical(2.0, Rounding::round(1.5));
  }

  public function testShouldRoundTheFractionalPartOfANumberAfterThreeDecimalPlacesBelowAHalfDownToTheNextInteger() {
    $this->assertIdentical(1.499, Rounding::round(1.499499, 3));
  }

  public function testShouldRoundTheFractionalPartOfANumberAfterThreeDecimalPlacesExactlyAHalfUpToTheNextInteger() {
    $this->assertIdentical(1.5, Rounding::round(1.4995, 3));
  }

  public function testShouldRoundTheFractionalPartOfANumberAfterThreeDecimalPlacesBelowAHalfDownToTheNextIntegerConsideringFourDecimalPlaces() {
    $this->assertIdentical(1.499, Rounding::round(1.499499, 3, 4));
  }

  public function testShouldRoundTheFractionalPartOfANumberAfterThreeDecimalPlacesExactlyAHalfUpToTheNextIntegerConsideringFourDecimalPlaces() {
    $this->assertIdentical(1.499, Rounding::round(1.4995, 3, 4));
  }

  public function testShouldRoundTwoUpToTwo() {
    $this->assertIdentical(2.0, Rounding::round_fraction_up(2.000000));
  }

  public function testShouldRoundANumberJustAboveOneUpToTwo() {
    $this->assertIdentical(2.0, Rounding::round_fraction_up(1.000001));
  }

  public function testShouldRoundOneUpToOne() {
    $this->assertIdentical(1.0, Rounding::round_fraction_up(1.000000));
  }

  public function testShouldRoundANumberJustAboveZeroUpToOne() {
    $this->assertIdentical(1.0, Rounding::round_fraction_up(0.000001));
  }

  public function testShouldRoundZeroUpToZero() {
    $this->assertIdentical(0.0, Rounding::round_fraction_up(0.0));
  }

  public function testShouldRoundNegativeZeroUpToNegativeZero() {
    $this->assertIdentical(-0.0, Rounding::round_fraction_up(-0.0));
  }

  public function testShouldRoundANumberJustAboveNegativeOneUpToNegativeZero() {
    $this->assertIdentical(-0.0, Rounding::round_fraction_up(-0.999999));
  }

  public function testShouldRoundNegativeOneUpToNegativeOne() {
    $this->assertIdentical(-1.0, Rounding::round_fraction_up(-1.000000));
  }

  public function testShouldRoundANumberJustAboveNegativeTwoUpToNegativeOne() {
    $this->assertIdentical(-1.0, Rounding::round_fraction_up(-1.999999));
  }

  public function testShouldRoundNegativeTwoUpToNegativeTwo() {
    $this->assertIdentical(-2.0, Rounding::round_fraction_up(-2.000000));
  }

  public function testShouldNotRoundAnIntegerUpToThreeDecimalPlaces() {
    $this->assertIdentical(1.0, Rounding::round_fraction_up(1.000000, 3));
  }

  public function testShouldRoundTheFractionalPartOfANumberUpToThreeDecimalPlaces() {
    $this->assertIdentical(1.001, Rounding::round_fraction_up(1.000001, 3));
  }

  public function testShouldNotRoundANegativeIntegerUpToThreeDecimalPlaces() {
    $this->assertIdentical(-2.0, Rounding::round_fraction_up(-2.000000, 3));
  }

  public function testShouldRoundTheFractionalPartOfANegativeNumberUpToThreeDecimalPlaces() {
    $this->assertIdentical(-1.999, Rounding::round_fraction_up(-1.999999, 3));
  }

  public function testShouldNotRoundAnIntegerUpToTheNextIntegerConsideringThreeDecimalPlaces() {
    $this->assertIdentical(1.0, Rounding::round_fraction_up(1.000499, 0, 3));
  }

  public function testShouldRoundTheFractionalPartOfANumberUpToTheNextIntegerConsideringThreeDecimalPlaces() {
    $this->assertIdentical(2.0, Rounding::round_fraction_up(1.000500, 0, 3));
  }

  public function testShouldNotRoundANegativeIntegerUpToTheNextIntegerConsideringThreeDecimalPlaces() {
    $this->assertIdentical(-2.0, Rounding::round_fraction_up(-1.999500, 0, 3));
  }

  public function testShouldRoundTheFractionalPartOfANegativeNumberUpToTheNextIntegerConsideringThreeDecimalPlaces() {
    $this->assertIdentical(-1.0, Rounding::round_fraction_up(-1.999499, 0, 3));
  }

  public function testShouldRoundNegativeZeroUpToNegativeZeroConsideringThreeDecimalPlaces() {
    $this->assertIdentical(-0.0, Rounding::round_fraction_up(-0.0, 0, 3));
  }

  public function testShouldNotRoundAnIntegerDownToTheNextInteger() {
    $this->assertIdentical(2.0, Rounding::round_fraction_down(2.000000));
  }

  public function testShouldRoundTheFractionalPartOfANumberDownToTheNextInteger() {
    $this->assertIdentical(1.0, Rounding::round_fraction_down(1.999999));
  }

  public function testShouldNotRoundANegativeIntegerDownToTheNextInteger() {
    $this->assertIdentical(-1.0, Rounding::round_fraction_down(-1.000000));
  }

  public function testShouldRoundTheFractionalPartOfANegativeNumberDownToTheNextInteger() {
    $this->assertIdentical(-2.0, Rounding::round_fraction_down(-1.000001));
  }

  public function testShouldNotRoundAnIntegerDownToThreeDecimalPlaces() {
    $this->assertIdentical(2.0, Rounding::round_fraction_down(2.000000, 3));
  }

  public function testShouldRoundTheFractionalPartOfANumberDownToThreeDecimalPlaces() {
    $this->assertIdentical(1.999, Rounding::round_fraction_down(1.999999, 3));
  }

  public function testShouldNotRoundANegativeIntegerDownToThreeDecimalPlaces() {
    $this->assertIdentical(-1.0, Rounding::round_fraction_down(-1.000000, 3));
  }

  public function testShouldRoundTheFractionalPartOfANegativeNumberDownToThreeDecimalPlaces() {
    $this->assertIdentical(-1.001, Rounding::round_fraction_down(-1.000001, 3));
  }

  public function testShouldNotRoundAnIntegerDownToTheNextIntegerConsideringThreeDecimalPlaces() {
    $this->assertIdentical(2.0, Rounding::round_fraction_down(1.999500, 0, 3));
  }

  public function testShouldRoundTheFractionalPartOfANumberDownToTheNextIntegerConsideringThreeDecimalPlaces() {
    $this->assertIdentical(1.0, Rounding::round_fraction_down(1.999499, 0, 3));
  }

  public function testShouldNotRoundANegativeIntegerDownToTheNextIntegerConsideringThreeDecimalPlaces() {
    $this->assertIdentical(-1.0, Rounding::round_fraction_down(-1.000499, 0, 3));
  }

  public function testShouldRoundTheFractionalPartOfANegativeNumberDownToTheNextIntegerConsideringThreeDecimalPlaces() {
    $this->assertIdentical(-2.0, Rounding::round_fraction_down(-1.000500, 0, 3));
  }

  public function testShouldRoundNegativeZeroDownToNegativeZero() {
    $this->assertIdentical(-0.0, Rounding::round_fraction_down(-0.0));
  }

  public function testShouldRoundNegativeZeroDownToNegativeZeroConsideringThreeDecimalPlaces() {
    $this->assertIdentical(-0.0, Rounding::round_fraction_down(-0.0, 0, 3));
  }

  public function testShouldNotRoundAnIntegerToTheNextIntegerTowardsZero() {
    $this->assertIdentical(2.0, Rounding::round_towards_zero(2.000000));
  }

  public function testShouldRoundTheFractionalPartOfANumberToTheNextIntegerTowardsZero() {
    $this->assertIdentical(1.0, Rounding::round_towards_zero(1.999999));
  }

  public function testShouldNotRoundANegativeIntegerToTheNextIntegerTowardsZero() {
    $this->assertIdentical(-2.0, Rounding::round_towards_zero(-2.000000));
  }

  public function testShouldRoundTheFractionalPartOfANegativeNumberToTheNextIntegerTowardsZero() {
    $this->assertIdentical(-1.0, Rounding::round_towards_zero(-1.999999));
  }

  public function testShouldNotRoundAnIntegerToThreeDecimalPlacesTowardsZero() {
    $this->assertIdentical(2.0, Rounding::round_towards_zero(2.000000, 3));
  }

  public function testShouldRoundTheFractionalPartOfANumberToThreeDecimalPlacesTowardsZero() {
    $this->assertIdentical(1.999, Rounding::round_towards_zero(1.999999, 3));
  }

  public function testShouldNotRoundANegativeIntegerToThreeDecimalPlacesTowardsZero() {
    $this->assertIdentical(-2.0, Rounding::round_towards_zero(-2.000000, 3));
  }

  public function testShouldRoundTheFractionalPartOfANegativeNumberToThreeDecimalPlacesTowardsZero() {
    $this->assertIdentical(-1.999, Rounding::round_towards_zero(-1.999999, 3));
  }

  public function testShouldNotRoundAnIntegerToTheNextIntegerTowardsZeroConsideringThreeDecimalPlaces() {
    $this->assertIdentical(2.0, Rounding::round_towards_zero(1.999500, 0, 3));
  }

  public function testShouldRoundTheFractionalPartOfANumberToTheNextIntegerTowardsZeroConsideringThreeDecimalPlaces() {
    $this->assertIdentical(1.0, Rounding::round_towards_zero(1.999499, 0, 3));
  }

  public function testShouldNotRoundANegativeIntegerToTheNextIntegerTowardsZeroConsideringThreeDecimalPlaces() {
    $this->assertIdentical(-2.0, Rounding::round_towards_zero(-1.999500, 0, 3));
  }

  public function testShouldRoundTheFractionalPartOfANegativeNumberToTheNextIntegerTowardsZeroConsideringThreeDecimalPlaces() {
    $this->assertIdentical(-1.0, Rounding::round_towards_zero(-1.999499, 0, 3));
  }

  public function testShouldRoundNegativeZeroTowardsZeroToNegativeZero() {
    $this->assertIdentical(-0.0, Rounding::round_towards_zero(-0.0));
  }

  public function testShouldRoundNegativeZeroTowardsZeroToNegativeZeroConsideringThreeDecimalPlaces() {
    $this->assertIdentical(-0.0, Rounding::round_towards_zero(-0.0, 0, 3));
  }

  public function testShouldNotRoundAnIntegerToTheNextIntegerAwayFromZero() {
    $this->assertIdentical(1.0, Rounding::round_away_from_zero(1.000000));
  }

  public function testShouldRoundTheFractionalPartOfANumberToTheNextIntegerAwayFromZero() {
    $this->assertIdentical(2.0, Rounding::round_away_from_zero(1.000001));
  }

  public function testShouldNotRoundANegativeIntegerToTheNextIntegerAwayFromZero() {
    $this->assertIdentical(-1.0, Rounding::round_away_from_zero(-1.000000));
  }

  public function testShouldRoundTheFractionalPartOfANegativeNumberToTheNextIntegerAwayFromZero() {
    $this->assertIdentical(-2.0, Rounding::round_away_from_zero(-1.000001));
  }

  public function testShouldNotRoundAnIntegerToThreeDecimalPlacesAwayFromZero() {
    $this->assertIdentical(1.0, Rounding::round_away_from_zero(1.000000, 3));
  }

  public function testShouldRoundTheFractionalPartOfANumberToThreeDecimalPlacesAwayFromZero() {
    $this->assertIdentical(1.001, Rounding::round_away_from_zero(1.000001, 3));
  }

  public function testShouldNotRoundANegativeIntegerToThreeDecimalPlacesAwayFromZero() {
    $this->assertIdentical(-1.0, Rounding::round_away_from_zero(-1.000000, 3));
  }

  public function testShouldRoundTheFractionalPartOfANegativeNumberToThreeDecimalPlacesAwayFromZero() {
    $this->assertIdentical(-1.001, Rounding::round_away_from_zero(-1.000001, 3));
  }

  public function testShouldNotRoundAnIntegerToTheNextIntegerAwayFromZeroConsideringThreeDecimalPlaces() {
    $this->assertIdentical(1.0, Rounding::round_away_from_zero(1.000499, 0, 3));
  }

  public function testShouldRoundTheFractionalPartOfANumberToTheNextIntegerAwayFromZeroConsideringThreeDecimalPlaces() {
    $this->assertIdentical(2.0, Rounding::round_away_from_zero(1.000500, 0, 3));
  }

  public function testShouldNotRoundANegativeIntegerToTheNextIntegerAwayFromZeroConsideringThreeDecimalPlaces() {
    $this->assertIdentical(-1.0, Rounding::round_away_from_zero(-1.000499, 0, 3));
  }

  public function testShouldRoundTheFractionalPartOfANegativeNumberToTheNextIntegerAwayFromZeroConsideringThreeDecimalPlaces() {
    $this->assertIdentical(-2.0, Rounding::round_away_from_zero(-1.000500, 0, 3));
  }

  public function testShouldRoundNegativeZeroAwayFromZeroToNegativeZero() {
    $this->assertIdentical(-0.0, Rounding::round_away_from_zero(-0.0));
  }

  public function testShouldRoundNegativeZeroAwayFromZeroToNegativeZeroConsideringThreeDecimalPlaces() {
    $this->assertIdentical(-0.0, Rounding::round_away_from_zero(-0.0, 0, 3));
  }
}
