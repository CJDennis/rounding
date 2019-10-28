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
  public function testShouldAdjustThePrecision() {
    $this->assertIdentical(1.499999, Rounding::adjust_precision(1.499999, 0));
  }

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

  public function testShouldRoundTwoUpToTwoToThreeDecimalPlaces() {
    $this->assertIdentical(2.000, Rounding::round_fraction_up(2.000000, 3));
  }

  public function testShouldRoundTwoUpToTwoConsideringThreeDecimalPlaces() {
    $this->assertIdentical(2.0, Rounding::round_fraction_up(2.000499, 0, 3));
  }

  public function testShouldRoundANumberJustAboveOneUpToTwo() {
    $this->assertIdentical(2.0, Rounding::round_fraction_up(1.000001));
  }

  public function testShouldRoundANumberJustAboveOneUpToANumberJustAboveOneToThreeDecimalPlaces() {
    $this->assertIdentical(1.001, Rounding::round_fraction_up(1.000001, 3));
  }

  public function testShouldRoundANumberJustAboveOneUpToTwoConsideringThreeDecimalPlaces() {
    $this->assertIdentical(2.0, Rounding::round_fraction_up(1.000500, 0, 3));
  }

  public function testShouldRoundOneUpToOne() {
    $this->assertIdentical(1.0, Rounding::round_fraction_up(1.000000));
  }

  public function testShouldRoundOneUpToOneToThreeDecimalPlaces() {
    $this->assertIdentical(1.000, Rounding::round_fraction_up(1.000000, 3));
  }

  public function testShouldRoundOneUpToOneConsideringThreeDecimalPlaces() {
    $this->assertIdentical(1.0, Rounding::round_fraction_up(1.000499, 0, 3));
  }

  public function testShouldRoundANumberJustAboveZeroUpToOne() {
    $this->assertIdentical(1.0, Rounding::round_fraction_up(0.000001));
  }

  public function testShouldRoundANumberJustAboveZeroUpToANumberJustAboveZeroToThreeDecimalPlaces() {
    $this->assertIdentical(0.001, Rounding::round_fraction_up(0.000001, 3));
  }

  public function testShouldRoundANumberJustAboveZeroUpToOneConsideringThreeDecimalPlaces() {
    $this->assertIdentical(1.0, Rounding::round_fraction_up(0.000500, 0, 3));
  }

  public function testShouldRoundZeroUpToZero() {
    $this->assertIdentical(0.0, Rounding::round_fraction_up(0.000000));
  }

  public function testShouldRoundZeroUpToZeroToThreeDecimalPlaces() {
    $this->assertIdentical(0.000, Rounding::round_fraction_up(0.000000, 3));
  }

  public function testShouldRoundZeroUpToZeroConsideringThreeDecimalPlaces() {
    $this->assertIdentical(0.0, Rounding::round_fraction_up(0.000499, 0, 3));
  }

  public function testShouldRoundNegativeZeroUpToNegativeZero() {
    $this->assertIdentical(-0.0, Rounding::round_fraction_up(-0.000000));
  }

  public function testShouldRoundNegativeZeroUpToNegativeZeroToThreeDecimalPlaces() {
    $this->assertIdentical(-0.000, Rounding::round_fraction_up(-0.000000, 3));
  }

  public function testShouldRoundNegativeZeroUpToNegativeZeroConsideringThreeDecimalPlaces() {
    $this->assertIdentical(-0.0, Rounding::round_fraction_up(-0.000000, 0, 3));
  }

  public function testShouldRoundANumberJustAboveNegativeOneUpToNegativeZero() {
    $this->assertIdentical(-0.0, Rounding::round_fraction_up(-0.999999));
  }

  public function testShouldRoundANumberJustAboveNegativeOneUpToANumberJustAboveNegativeOneToThreeDecimalPlaces() {
    $this->assertIdentical(-0.999, Rounding::round_fraction_up(-0.999999, 3));
  }

  public function testShouldRoundANumberJustAboveNegativeOneUpToNegativeZeroConsideringThreeDecimalPlaces() {
    $this->assertIdentical(-0.0, Rounding::round_fraction_up(-0.999499, 0, 3));
  }

  public function testShouldRoundNegativeOneUpToNegativeOne() {
    $this->assertIdentical(-1.0, Rounding::round_fraction_up(-1.000000));
  }

  public function testShouldRoundNegativeOneUpToNegativeOneToThreeDecimalPlaces() {
    $this->assertIdentical(-1.000, Rounding::round_fraction_up(-1.000000, 3));
  }

  public function testShouldRoundNegativeOneUpToNegativeOneConsideringThreeDecimalPlaces() {
    $this->assertIdentical(-1.0, Rounding::round_fraction_up(-0.999500, 0, 3));
  }

  public function testShouldRoundANumberJustAboveNegativeTwoUpToNegativeOne() {
    $this->assertIdentical(-1.0, Rounding::round_fraction_up(-1.999999));
  }

  public function testShouldRoundANumberJustAboveNegativeTwoUpToANumberJustAboveNegativeTwoToThreeDecimalPlaces() {
    $this->assertIdentical(-1.999, Rounding::round_fraction_up(-1.999999, 3));
  }

  public function testShouldRoundANumberJustAboveNegativeTwoUpToNegativeOneConsideringThreeDecimalPlaces() {
    $this->assertIdentical(-1.0, Rounding::round_fraction_up(-1.999499, 0, 3));
  }

  public function testShouldRoundNegativeTwoUpToNegativeTwo() {
    $this->assertIdentical(-2.0, Rounding::round_fraction_up(-2.000000));
  }

  public function testShouldRoundNegativeTwoUpToNegativeTwoToThreeDecimalPlaces() {
    $this->assertIdentical(-2.000, Rounding::round_fraction_up(-2.000000, 3));
  }

  public function testShouldRoundNegativeTwoUpToNegativeTwoConsideringThreeDecimalPlaces() {
    $this->assertIdentical(-2.0, Rounding::round_fraction_up(-1.999500, 0, 3));
  }

  public function testShouldRoundTwoDownToTwo() {
    $this->assertIdentical(2.0, Rounding::round_fraction_down(2.000000));
  }

  public function testShouldRoundTwoDownToTwoToThreeDecimalPlaces() {
    $this->assertIdentical(2.000, Rounding::round_fraction_down(2.000000, 3));
  }

  public function testShouldRoundTwoDownToTwoConsideringThreeDecimalPlaces() {
    $this->assertIdentical(2.0, Rounding::round_fraction_down(1.999500, 0, 3));
  }

  public function testShouldRoundANumberJustBelowTwoDownToOne() {
    $this->assertIdentical(1.0, Rounding::round_fraction_down(1.999999));
  }

  public function testShouldRoundANumberJustBelowTwoDownToANumberJustBelowTwoToThreeDecimalPlaces() {
    $this->assertIdentical(1.999, Rounding::round_fraction_down(1.999999, 3));
  }

  public function testShouldRoundANumberJustBelowTwoDownToOneConsideringThreeDecimalPlaces() {
    $this->assertIdentical(1.0, Rounding::round_fraction_down(1.999499, 0, 3));
  }

  public function testShouldRoundOneDownToOne() {
    $this->assertIdentical(1.0, Rounding::round_fraction_down(1.000000));
  }

  public function testShouldRoundOneDownToOneToThreeDecimalPlaces() {
    $this->assertIdentical(1.000, Rounding::round_fraction_down(1.000000, 3));
  }

  public function testShouldRoundOneDownToOneConsideringThreeDecimalPlaces() {
    $this->assertIdentical(1.0, Rounding::round_fraction_down(0.999500, 0, 3));
  }

  public function testShouldRoundANumberJustBelowOneDownToZero() {
    $this->assertIdentical(0.0, Rounding::round_fraction_down(0.999999));
  }

  public function testShouldRoundANumberJustBelowOneDownToANumberJustBelowOneToThreeDecimalPlaces() {
    $this->assertIdentical(0.999, Rounding::round_fraction_down(0.999999, 3));
  }

  public function testShouldRoundANumberJustBelowOneDownToZeroConsideringThreeDecimalPlaces() {
    $this->assertIdentical(0.0, Rounding::round_fraction_down(0.999499, 0, 3));
  }

  public function testShouldRoundZeroDownToZero() {
    $this->assertIdentical(0.0, Rounding::round_fraction_down(0.000000));
  }

  public function testShouldRoundZeroDownToZeroToThreeDecimalPlaces() {
    $this->assertIdentical(0.000, Rounding::round_fraction_down(0.000000, 3));
  }

  public function testShouldRoundZeroDownToZeroConsideringThreeDecimalPlaces() {
    $this->assertIdentical(0.0, Rounding::round_fraction_down(0.000000, 0, 3));
  }

  public function testShouldRoundNegativeZeroDownToNegativeZero() {
    $this->assertIdentical(-0.0, Rounding::round_fraction_down(-0.000000));
  }

  public function testShouldRoundNegativeZeroDownToNegativeZeroToThreeDecimalPlaces() {
    $this->assertIdentical(-0.000, Rounding::round_fraction_down(-0.000000, 3));
  }

  public function testShouldRoundNegativeZeroDownToNegativeZeroConsideringThreeDecimalPlaces() {
    $this->assertIdentical(-0.0, Rounding::round_fraction_down(-0.000499, 0, 3));
  }

  public function testShouldRoundANumberJustBelowZeroDownToNegativeOne() {
    $this->assertIdentical(-1.0, Rounding::round_fraction_down(-0.000001));
  }

  public function testShouldRoundANumberJustBelowZeroDownToANumberJustBelowZeroToThreeDecimalPlaces() {
    $this->assertIdentical(-0.001, Rounding::round_fraction_down(-0.000001, 3));
  }

  public function testShouldRoundANumberJustBelowZeroDownToNegativeOneConsideringThreeDecimalPlaces() {
    $this->assertIdentical(-1.0, Rounding::round_fraction_down(-0.000500, 0, 3));
  }

  public function testShouldRoundNegativeOneDownToNegativeOne() {
    $this->assertIdentical(-1.0, Rounding::round_fraction_down(-1.000000));
  }

  public function testShouldRoundNegativeOneDownToNegativeOneToThreeDecimalPlaces() {
    $this->assertIdentical(-1.000, Rounding::round_fraction_down(-1.000000, 3));
  }

  public function testShouldRoundNegativeOneDownToNegativeOneConsideringThreeDecimalPlaces() {
    $this->assertIdentical(-1.0, Rounding::round_fraction_down(-1.000499, 0, 3));
  }

  public function testShouldRoundANumberJustBelowNegativeOneDownToNegativeTwo() {
    $this->assertIdentical(-2.0, Rounding::round_fraction_down(-1.000001));
  }

  public function testShouldRoundANumberJustBelowNegativeOneDownToANumberJustBelowNegativeOneToThreeDecimalPlaces() {
    $this->assertIdentical(-1.001, Rounding::round_fraction_down(-1.000001, 3));
  }

  public function testShouldRoundANumberJustBelowNegativeOneDownToNegativeTwoConsideringThreeDecimalPlaces() {
    $this->assertIdentical(-2.0, Rounding::round_fraction_down(-1.000500, 0, 3));
  }

  public function testShouldRoundNegativeTwoDownToNegativeTwo() {
    $this->assertIdentical(-2.0, Rounding::round_fraction_down(-2.000000));
  }

  public function testShouldRoundNegativeTwoDownToNegativeTwoToThreeDecimalPlaces() {
    $this->assertIdentical(-2.000, Rounding::round_fraction_down(-2.000000, 3));
  }

  public function testShouldRoundNegativeTwoDownToNegativeTwoConsideringThreeDecimalPlaces() {
    $this->assertIdentical(-2.0, Rounding::round_fraction_down(-2.000499, 0, 3));
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
